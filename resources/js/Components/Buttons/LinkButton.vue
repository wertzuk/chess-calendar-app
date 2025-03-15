<template>
    <Link
        as="button"
        class="py-2.5 px-5 me-2 text-sm font-medium text-white focus:outline-none bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-700 hover:border-blue-800 hover:text-white focus:z-10 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800 dark:bg-blue-700 dark:text-white dark:border-blue-700 dark:hover:bg-blue-900"
    >
        <slot></slot>
    </Link>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>
