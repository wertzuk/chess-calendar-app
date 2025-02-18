<script setup lang="ts">
import IconSearch from './Icons/IconSearch.vue';

const model = defineModel();
</script>

<template>
    <form class="max-w-md">
        <label
            for="default-search"
            class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white"
            >Search</label
        >
        <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <IconSearch />
            </div>
            <input
                type="search"
                id="default-search"
                v-model="model"
                class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Durchsuchen..."
            />
        </div>
    </form>
</template>
