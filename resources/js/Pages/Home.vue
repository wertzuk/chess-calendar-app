<template>
    <Head title="Home" />

    <MainLayout>
        <MainHeading>Schachturnier-Kalender</MainHeading>
        <div class="mb-10">
            <LinkButton :href="route('tournaments.create')" preserve-scroll as="button"
                >Turnier erstellen</LinkButton
            >
        </div>
        <div v-if="tournaments.length">
            <div v-for="(group, month) in groupedTournaments" :key="date">
                <ol class="relative border-s border-gray-200 dark:border-gray-700">
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
        <div v-else><Paragraph>Keine Turniere gefunden!</Paragraph></div>
    </MainLayout>
</template>

<script setup>
import { computed } from 'vue';
import { Head } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import TournamentCard from '@/Components/TournamentCard.vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import Paragraph from '@/Components/Common/Paragraph.vue';
import MainHeading from '@/Components/Common/MainHeading.vue';
import LinkButton from '@/Components/Buttons/LinkButton.vue';

const tournaments = computed(() => usePage().props.tournaments ?? []);
groupTournaments(tournaments.value);
const groupedTournaments = computed(() => groupTournaments(tournaments.value));

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
