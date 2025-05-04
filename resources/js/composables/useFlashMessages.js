import { ref, onMounted } from 'vue';
import { usePage } from '@inertiajs/vue3';

export function useFlashMessages() {
    const { error, success } = usePage().props.flash;
    const showSuccess = ref(success);

    onMounted(() => {
        // Clear Inertia props (otherwise, upon redirection back, they will reappear)
        usePage().props.flash.success = null; 
        usePage().props.flash.error = null;
        if (showSuccess.value) {
            setTimeout(() => {
                showSuccess.value = null;
            }, 3000);
        }
    });

    return {
        error,
        showSuccess,
    };
}
