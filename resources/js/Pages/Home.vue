<template>
    <Head title="Home" />

    <MainLayout>
        <MainHeading>Schachturnier-Kalender</MainHeading>
        <div class="mb-10">
            <LinkButton
                :href="route('tournaments.create')"
                preserve-scroll
                as="button"
                v-if="isLoggedIn"
                >Turnier erstellen</LinkButton
            >
        </div>
        <div>
            <SearchBar @input="search" class="mb-12" v-model="searchTerm"></SearchBar>
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
        <div v-if="success">
            <ToastSuccess>{{ success }}</ToastSuccess>
        </div>
        <div v-if="error">
            <ToastError>{{ error }}</ToastError>
        </div>
    </MainLayout>
    <Confirm v-if="isLoggedIn" />
</template>

<script setup>
import { computed, onMounted, ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import { usePage, router } from '@inertiajs/vue3';
import { debounce } from 'lodash';
import TournamentCard from '@/Components/TournamentCard.vue';
import SearchBar from '@/Components/SearchBar.vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import Paragraph from '@/Components/Common/Paragraph.vue';
import MainHeading from '@/Components/Common/MainHeading.vue';
import LinkButton from '@/Components/Buttons/LinkButton.vue';
import Confirm from '@/Components/Common/Confirm.vue';
import ToastSuccess from '@/Components/Toast/ToastSuccess.vue';
import ToastError from '@/Components/Toast/ToastError.vue';

const tournaments = computed(() => usePage().props.tournaments ?? []);
const groupedTournaments = computed(() => groupTournaments(tournaments.value));
const isLoggedIn = computed(() => !!usePage().props.auth.user);
const { error, success } = usePage().props.flash;
const searchTerm = ref('');

onMounted(() => {
    initFlowbite();
});

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

const search = debounce(() => {
    console.log('Searching for:', searchTerm.value);
    const params = searchTerm.value ? { search: searchTerm.value } : {};
    router.get('/', params, { preserveState: true });
}, 300);

function transformDate(date) {
    const options = {
        year: 'numeric',
        month: 'long',
    };

    return date.toLocaleDateString('de-DE', options);
}
</script>
