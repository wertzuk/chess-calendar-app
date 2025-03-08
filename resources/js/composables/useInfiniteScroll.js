import { onMounted, onUnmounted } from 'vue';

export function useInfiniteScroll(loadMore) {
    const handleScroll = () => {
        const bottomOfWindow =
            document.documentElement.scrollTop + window.innerHeight >=
            document.documentElement.offsetHeight - 100;

        if (bottomOfWindow) {
            loadMore();
        }
    };

    onMounted(() => {
        window.addEventListener('scroll', handleScroll);
    });

    onUnmounted(() => {
        window.removeEventListener('scroll', handleScroll);
    });
}
