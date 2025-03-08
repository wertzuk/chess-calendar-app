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

        <!-- <pre class="text-white">{{ groupedTournaments }}</pre> -->

        <div v-if="showSuccess">
            <ToastSuccess>{{ showSuccess }}</ToastSuccess>
        </div>
        <div v-if="error">
            <ToastError>{{ error }}</ToastError>
        </div>
    </MainLayout>
</template>

<script setup>
import { computed, ref } from 'vue';
import { useTournaments, useInfiniteScroll, useSearch, useFlashMessages } from '@/composables';
import { Head } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import TournamentCard from '@/Components/TournamentCard.vue';
import SearchBar from '@/Components/SearchBar.vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import Paragraph from '@/Components/Common/Paragraph.vue';
import MainHeading from '@/Components/Common/MainHeading.vue';
import LinkButton from '@/Components/Buttons/LinkButton.vue';
import ToastSuccess from '@/Components/Toast/ToastSuccess.vue';
import ToastError from '@/Components/Toast/ToastError.vue';

const initialTournaments = usePage().props.tournaments ?? [];
const tournaments = ref(initialTournaments); // Use a ref for tournaments
const isLoggedIn = computed(() => !!usePage().props.auth.user);
const loading = ref(false);

const { groupedTournaments } = useTournaments(tournaments);
const { searchTerm, search, noMoreResults, currentPage } = useSearch(tournaments); // Pass tournaments ref to useSearch
const { showSuccess, error } = useFlashMessages();

// Load more tournaments for infinite scroll
const loadMore = async () => {
    if (loading.value || noMoreResults.value) return;

    loading.value = true;
    currentPage.value++;

    try {
        const params = {
            page: currentPage.value,
        };

        if (searchTerm.value) {
            params.searchTerm = searchTerm.value;
        }

        const response = await axios.get('/tournaments/load-more', { params });

        if (!response.data.hasMore) {
            noMoreResults.value = true;
        }
        // Append new tournaments to the existing array
        tournaments.value = [...tournaments.value, ...response.data.tournaments];
    } catch (error) {
        console.error('Error loading more tournaments:', error);
    } finally {
        loading.value = false;
    }
};

useInfiniteScroll(loadMore);
</script>
