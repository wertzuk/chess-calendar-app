<template>
    <button
        :class="[
            'font-medium rounded-lg text-sm px-5 py-2.5 mb-2 focus:outline-none',
            customClasses,
            ringClasses,
            hoverClasses,
            darkModeClasses,
        ]"
        :type="type"
    >
        <slot></slot>
    </button>
</template>

<script setup>
const props = defineProps({
    type: {
        type: String,
        default: 'button',
    },
    customClasses: {
        type: String,
        default: '', // Allow extending with specific classes
    },
    ringClasses: {
        type: String,
        default: '', // Focus ring styling
    },
    hoverClasses: {
        type: String,
        default: '', // Hover state styling
    },
    darkModeClasses: {
        type: String,
        default: '', // Dark mode-specific styling
    },
});
</script>
