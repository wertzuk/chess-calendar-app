<template>
    <div>
        <span
            class="inline-flex uppercase items-center font-light px-3 py-1 bg-gray-200 text-gray-700 text-sm rounded-full dark:bg-gray-700 dark:text-gray-300"
            :class="{
                'dark:bg-emerald-900/50 dark:text-emerald-200': !isIconChip,
            }"
        >
            <slot></slot>
        </span>
    </div>
</template>

<script setup>
const props = defineProps(['isIconChip']);
</script>
