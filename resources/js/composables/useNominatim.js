// composables/useNominatim.js
import { ref } from 'vue';

export function useNominatim() {
    const suggestions = ref([]);
    const isLoading = ref(false);
    const error = ref(null);

    const searchAddress = async (query, country = 'de', limit = 5) => {
        if (!query || query.length < 3) {
            suggestions.value = [];
            return;
        }

        isLoading.value = true;
        error.value = null;

        try {
            const response = await fetch(
                `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}&countrycodes=${country}&limit=${limit}`,
                {
                    headers: {
                        'User-Agent': 'YourAppName (contact@yourdomain.com)'
                    }
                }
            );

            if (!response.ok) throw new Error('Network response was not ok');

            const data = await response.json();
            suggestions.value = data.map(item => ({
                ...item,
                lat: parseFloat(item.lat),
                lon: parseFloat(item.lon),
                address: {
                    city: item.address?.city || item.address?.town || '',
                    postcode: item.address?.postcode || '',
                    street: [item.address?.road, item.address?.house_number].filter(Boolean).join(' ') || ''
                }
            }));
            console.log(suggestions.value);
            
        } catch (err) {
            error.value = err.message;
            console.error('Nominatim API error:', err);
        } finally {
            isLoading.value = false;
        }
    };

    const clearSuggestions = () => {
        suggestions.value = [];
    };

    return {
        suggestions,
        isLoading,
        error,
        searchAddress,
        clearSuggestions
    };
}