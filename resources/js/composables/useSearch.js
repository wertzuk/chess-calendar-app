import { ref, reactive, watch } from 'vue';
import { router } from '@inertiajs/vue3';
import { debounce } from 'lodash';

export function useSearch(tournaments) {
    const filters = reactive({
        searchTerm: '',
        type: '',
    });

    const debouncedSearchTerm = ref(filters.searchTerm);

    watch(
        () => filters.searchTerm,
        debounce((val) => {
            debouncedSearchTerm.value = val;
            search();
            console.log(val);
        }, 300)
    );

    watch(
        () => filters.type,
        (val) => {
            search();
            console.log('Filter type changed:', val);
        }
    );
    const noMoreResults = ref(false);
    const currentPage = ref(1);

    const search = () => {
        console.log('search');
        const params = {};
        if (filters.searchTerm) params.search = filters.searchTerm;
        if (filters.type) params.type = filters.type;
        router.get('/', params, {
            preserveState: true,
            replace: true,
            onSuccess: (page) => {
                // Manually update the tournaments array with the new data
                tournaments.value = page.props.tournaments;
                noMoreResults.value = !page.props.hasMore;
                currentPage.value = 1;
            },
            onFinish: () => console.log('Filtering finished'),
        });
    };

    return {
        noMoreResults,
        currentPage,
        search,
        filters,
        debouncedSearchTerm,
    };
}
