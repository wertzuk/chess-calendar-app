<script setup lang="ts">

import DateRange from '@/Components/Common/DateRange.vue';

defineProps({
    tournaments: Array
});

</script>

<template>
    <div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table
                class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
            >
                <thead
                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                >
                <tr>
                    <th scope="col" class="px-6 py-3">Name</th>
                    <th scope="col" class="px-6 py-3">Datum</th>
                    <th scope="col" class="px-6 py-3">Category</th>
                    <th scope="col" class="px-6 py-3">Ort</th>
                </tr>
                </thead>
                <tbody>
                <tr
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200"
                    v-for="tournament in tournaments"
                    :key="tournament.id"
                >
                    <th
                        scope="row"
                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                    >
                        {{ tournament.title }}
                    </th>
                    <td class="px-6 py-4">
                        <DateRange
                            :start="tournament.start_date"
                            :end="tournament.end_date"
                            class="text-sm mb-2 font-light text-gray-700 dark:text-gray-400"
                        ></DateRange>
                    </td>
                    <td class="px-6 py-4">{{ tournament.chess_type }}</td>
                    <td class="px-6 py-4">{{ tournament.location.city }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
