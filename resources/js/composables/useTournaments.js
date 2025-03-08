import { computed } from 'vue';

export function useTournaments(tournaments) {
    const groupedTournaments = computed(() => {
        const sortedTournaments = [...tournaments.value].sort(
            (a, b) => new Date(a.start_date) - new Date(b.start_date)
        );

        // Group tournaments by month (needed for timeline)
        return sortedTournaments.reduce((grouped, event) => {
            const transformedDate = transformDate(new Date(event.start_date));
            if (!grouped[transformedDate]) {
                grouped[transformedDate] = [];
            }
            grouped[transformedDate].push(event);
            return grouped;
        }, {});
    });

    const transformDate = (date) => {
        const options = {
            year: 'numeric',
            month: 'long',
        };
        return date.toLocaleDateString('de-DE', options);
    };

    return { groupedTournaments };
}
