<template>
    <p>
        <span>{{ startDate }}</span>
        <span v-if="endDate && endDate !== startDate"> - {{ endDate }}</span>
    </p>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
    start: String,
    end: String,
});

const startDate = computed(() => {
    const date = new Date(props.start);
    return convertDateFormatToDDMMYYYY(date);
});

const endDate = computed(() => {
    const date = new Date(props.end);
    return convertDateFormatToDDMMYYYY(date);
});

function convertDateFormatToDDMMYYYY(date) {
    if (!date || isNaN(date)) {
        return null;
    }

    return `${addLeadingZero(date.getDate())}.${addLeadingZero(
        date.getMonth() + 1
    )}.${date.getFullYear()}`;
}

/**
 * Add leading zero to a number if it has exactly one digit (used to properly display dates)
 */
function addLeadingZero(n) {
    return n < 10 ? '0' + n : n;
}
</script>
