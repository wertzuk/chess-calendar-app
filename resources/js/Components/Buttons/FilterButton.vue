<template>
    <button
        class="py-3 px-4 text-sm rounded-lg flex items-center leading-none"
        :class="{
            'dark:bg-gray-400 dark:text-gray-900': active,
            'dark:bg-gray-950 dark:text-white': !active,
        }"
    >
        <slot />
    </button>
</template>

<script setup>
defineProps({ active: Boolean });
</script>
