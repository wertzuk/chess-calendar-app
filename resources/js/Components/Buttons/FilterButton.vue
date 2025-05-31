<template>
    <button
        class="py-3 px-4 text-sm rounded-lg flex items-center leading-none"
        :class="{
            // ACTIVE STATE
            'bg-neutral-900 text-neutral-100 dark:bg-neutral-200 dark:text-black': active,

            // INACTIVE STATE
            'bg-neutral-300 text-neutral-800 dark:bg-neutral-950 dark:text-neutral-200 hover:bg-neutral-200 dark:hover:bg-gray-800':
                !active,
        }"
    >
        <slot />
    </button>
</template>

<script setup>
defineProps({ active: Boolean });
</script>
