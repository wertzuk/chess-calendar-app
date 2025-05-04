import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import { debounce } from 'lodash';

export function useSearch(tournaments) {
    const searchTerm = ref('');
    const typeFilter = ref('');
    const noMoreResults = ref(false);
    const currentPage = ref(1);

    const search = debounce(() => {
        console.log('search');

        const params = {};
        if (searchTerm.value) params.search = searchTerm.value;
        if (typeFilter.value) params.type = typeFilter.value;

        router.get('/', params, {
            preserveState: true,
            onSuccess: (page) => {
                // Manually update the tournaments array with the new data
                tournaments.value = page.props.tournaments;
                noMoreResults.value = !page.props.hasMore;
                currentPage.value = 1;
            },
            onFinish: () => console.log('Filtering finished'),
        });
    }, 300);

    return {
        searchTerm,
        noMoreResults,
        currentPage,
        typeFilter,
        search,
    };
}
