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
            <ToastSuccess>{{ success }}</ToastSuccess>
        </div>
        <div v-if="error">
            <ToastError>{{ error }}</ToastError>
        </div>
    </MainLayout>
    <Confirm v-if="isLoggedIn" />
</template>

<script setup>
import { computed, onMounted, onUnmounted, ref } from 'vue';
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

const initialTournaments = usePage().props.tournaments ?? [];
const tournaments = ref(initialTournaments); // Use a ref for tournaments
const isLoggedIn = computed(() => !!usePage().props.auth.user);
const hasMore = computed(() => usePage().props.hasMore ?? false);
const { error, success } = usePage().props.flash;

const searchTerm = ref('');
const showSuccess = ref(success);
const loading = ref(false);
const noMoreResults = ref(!hasMore.value);
const currentPage = ref(1);

onMounted(() => {
    if (showSuccess.value) {
        setTimeout(() => {
            showSuccess.value = null;
        }, 3000);
    }
});

/**
 * Group tournaments by month
 *
 * @param {array} tournaments
 */
// Computed property to group tournaments by month
const groupedTournaments = computed(() => {
    const sortedTournaments = [...tournaments.value].sort(
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
});

const search = debounce(() => {
    console.log('Searching for:', searchTerm.value);
    const params = searchTerm.value ? { search: searchTerm.value } : {};
    router.get('/', params, {
        preserveState: true,
        onSuccess: (page) => {
            // Manually update the tournaments array with the new data
            tournaments.value = page.props.tournaments;
            noMoreResults.value = !page.props.hasMore;
            currentPage.value = 1; // Reset the page counter for infinite scroll
        },
        onFinish: () => console.log('Filtering finished'),
    });
}, 300);

// Load more tournaments
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

// Detect scroll to bottom
const handleScroll = () => {
    const bottomOfWindow =
        document.documentElement.scrollTop + window.innerHeight >=
        document.documentElement.offsetHeight - 100;

    if (bottomOfWindow) {
        loadMore();
    }
};

// Add scroll event listener
onMounted(() => {
    window.addEventListener('scroll', handleScroll);
});

// Clean up scroll event listener
onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
});

function transformDate(date) {
    const options = {
        year: 'numeric',
        month: 'long',
    };

    return date.toLocaleDateString('de-DE', options);
}
</script>
