<template>
    <Link
        type="button"
        class="text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:focus:ring-blue-800 dark:hover:bg-blue-500"
    >
        <slot></slot>
        <span class="sr-only">Icon description</span>
    </Link>
</template>
<script setup>
import { Link } from '@inertiajs/vue3';
</script>
