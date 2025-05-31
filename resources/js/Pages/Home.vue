<template>
    <Head title="Home" />

    <MainLayout>
        <MainHeading class="mb-12">Schachturnier-Kalender</MainHeading>

        <div class="flex gap-2 mb-6 flex-wrap">
            <FilterButton
                v-for="t in types"
                :key="t.value"
                @click="filters.type = t.value"
                :active="filters.type === t.value"
            >
                {{ t.label }}
            </FilterButton>
        </div>

        <div>
            <SearchBar class="mb-12" v-model="filters.searchTerm"></SearchBar>
        </div>

        <div v-if="tournaments.length">
            <div v-for="(group, month) in groupedTournaments" :key="date">
                <ol class="relative border-s border-gray-300 dark:border-gray-700">
                    <li class="ms-4 pb-12">
                        <div
                            class="absolute w-3 h-3 bg-gray-300 rounded-full mt-1.5 -start-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"
                        ></div>
                        <time class="mb-1 text-sm font-normal leading-none text-gray-500">{{
                            month
                        }}</time>
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
import FilterButton from '@/Components/Buttons/FilterButton.vue';
import ToastSuccess from '@/Components/Toast/ToastSuccess.vue';
import ToastError from '@/Components/Toast/ToastError.vue';

const initialTournaments = usePage().props.tournaments ?? [];
const tournaments = ref(initialTournaments);
const isLoggedIn = computed(() => !!usePage().props.auth.user);
const loading = ref(false);

const { groupedTournaments } = useTournaments(tournaments);
const { noMoreResults, currentPage, filters } = useSearch(tournaments);
const { showSuccess, error } = useFlashMessages();
const types = [
    { label: 'Alle', value: '' },
    { label: 'Klassisch', value: 'Klassisch' },
    { label: 'Schnellschach', value: 'Schnellschach' },
    { label: 'Blitz', value: 'Blitz' },
];

// Load more tournaments for infinite scroll
const loadMore = async () => {
    if (loading.value || noMoreResults.value) return;

    loading.value = true;
    currentPage.value++;

    try {
        const params = {
            page: currentPage.value,
        };

        if (filters.searchTerm) params.search = filters.searchTerm;
        if (filters.type) params.type = filters.type;

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
