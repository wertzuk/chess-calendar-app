<script setup>
import { Link } from '@inertiajs/vue3';
import IconAdd from '../Icons/IconAdd.vue';
</script>

<template>
    <Link
        href="#"
        class="fixed bottom-5 z-10 sm:bottom-20 right-4 sm:right-[10%] flex gap-2 items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
    >
        <IconAdd />
        <span>Turnier erstellen</span>
    </Link>
</template>
