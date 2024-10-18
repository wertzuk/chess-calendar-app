<template>
    <Head title="Home" />

    <MainLayout>
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12">
            <div
                class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800"
            >
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p v-if="$page.props.auth.user">You're logged in!</p>
                    <p v-else>Hello guest!</p>
                </div>
            </div>
            <div v-for="(group, month) in groupedTournaments" :key="date">
                {{ month }}

                <div class="mt-8 grid grid-cols-fill-300 gap-4 mx-auto">
                    <TournamentCard
                        :tournament="tournament"
                        v-for="tournament in group"
                        :key="tournament.id"
                    />
                </div>
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
    return tournaments.reduce((grouped, event) => {
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
