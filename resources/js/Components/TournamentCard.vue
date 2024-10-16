<template>
    <div
        class="p-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 flex flex-col"
    >
        <h5
            class="mb-1 text-xl font-bold tracking-tight text-gray-900 dark:text-white"
        >
            {{ tournament.title }}
        </h5>
        <p class="mb-6 font-normal text-sm text-gray-700 dark:text-gray-400">
            10.10.2024 - 12.10.2024
        </p>
        <div class="flex gap-2 flex-grow-0 mt-auto">
            <Chip>{{ tournament.chess_type }}</Chip>
            <Chip v-if="tournament.elo_rated">ELO</Chip>
            <Chip v-if="tournament.dwz_rated">DWZ</Chip>
            <Chip v-if="tournament.rapid_elo_rated">Rapid-ELO</Chip>
            <Chip v-if="tournament.blitz_elo_rated">Blitz-ELO</Chip>
        </div>
    </div>
</template>

<script setup lang="ts">
import Chip from './Chip.vue';

const props = defineProps(['tournament']);

console.log(props.tournament.id);
</script>
