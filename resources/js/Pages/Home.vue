<template>
    <Head title="Home" />

    <MainLayout>
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12">
            <div class="mb-10">
                <IconButton>Turnier erstellen</IconButton>
            </div>
            <div
                class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800"
            ></div>
            <div v-for="(group, month) in groupedTournaments" :key="date">
                <ol
                    class="relative border-s border-gray-200 dark:border-gray-700"
                >
                    <li class="ms-4 pb-12">
                        <div
                            class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -start-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"
                        ></div>
                        <time
                            class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500"
                            >{{ month }}</time
                        >
                        <div class="mt-2 grid grid-cols-fill-300 gap-4 mx-auto">
                            <TournamentCard
                                :tournament="tournament"
                                v-for="tournament in group"
                                :key="tournament.id"
                            />
                        </div>
                    </li>
                </ol>
            </div>
        </div>
    </MainLayout>
</template>

<script setup>
import { computed } from 'vue';
import TournamentCard from '@/Components/TournamentCard.vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue';
import IconButton from '@/Components/Buttons/IconButton.vue';
const tournaments = computed(() => usePage().props.tournaments);

groupTournaments(tournaments.value);
const groupedTournaments = computed(() => groupTournaments(tournaments.value));
console.log(groupedTournaments.value);

/**
 * Group tournaments by month
 *
 * @param {array} tournaments
 */
function groupTournaments(tournaments) {
    const sortedTournaments = tournaments.sort(
        (a, b) => new Date(a.start_date) - new Date(b.start_date)
    );
    return sortedTournaments.reduce((grouped, event) => {
        const transformedDate = transformDate(new Date(event.start_date));
        if (!grouped[transformedDate]) {
            grouped[transformedDate] = [];
        }
        grouped[transformedDate].push(event);
        return grouped;
    }, {});
}

function transformDate(date) {
    const options = {
        year: 'numeric',
        month: 'long',
    };

    return date.toLocaleDateString('de-DE', options);
}
</script>
