<script setup>
import IconDelete from '../Icons/IconDelete.vue';
</script>

<template>
    <button
        type="button"
        title="Löschen"
        class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-full text-sm p-1.5 text-center inline-flex items-center me-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
    >
        <IconDelete />
        <span class="sr-only">Löschen</span>
    </button>
</template>
