<script setup>
import IconEdit from '../Icons/IconEdit.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <Link
        as="button"
        title="Bearbeiten"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-1.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 self-baseline"
    >
        <IconEdit />
        <span class="sr-only">Bearbeiten</span>
    </Link>
</template>
