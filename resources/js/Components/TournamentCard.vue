<template>
    <div
        class="p-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 flex flex-col"
    >
        <h5
            class="mb-1 text-xl font-bold tracking-tight text-gray-900 dark:text-white"
        >
            {{ tournament.title }}
        </h5>
        <p class="mb-6 font-normal text-sm text-gray-700 dark:text-gray-400">
            <span>{{ startDate }}</span>
            <span v-if="endDate && endDate !== startDate">
                - {{ endDate }}</span
            >
        </p>
        <div class="flex gap-2 flex-grow-0 mt-auto">
            <Chip class="flex gap-1" isIconChip="true">
                <IconLocation />
                <span>{{ tournament.city ?? 'Berlin' }}</span>
            </Chip>
            <Chip>{{ tournament.chess_type }}</Chip>
            <!-- <Chip v-if="tournament.city">{{ tournament.city }}</Chip> -->
            <Chip v-if="tournament.elo_rated">ELO</Chip>
            <Chip v-if="tournament.dwz_rated">DWZ</Chip>
            <Chip v-if="tournament.rapid_elo_rated">Rapid-ELO</Chip>
            <Chip v-if="tournament.blitz_elo_rated">Blitz-ELO</Chip>
        </div>
    </div>
</template>

<script setup lang="ts">
import { computed } from 'vue';
import Chip from './Chip.vue';
import IconLocation from './Icons/IconLocation.vue';

const props = defineProps(['tournament']);

const startDate = computed(() => {
    const date = new Date(props.tournament.start_date);
    return convertDateFormatToDDMMYYYY(date);
});

const endDate = computed(() => {
    const date = new Date(props.tournament.end_date);
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
 *
 * @param {number} n
 */
function addLeadingZero(n) {
    return n < 10 ? '0' + n : n;
}
</script>
