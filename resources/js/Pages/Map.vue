<template>
    <Head title="Map" />
    <!--  -->
    <MainLayout>
        <div class="absolute inset-0 ">
            <div id="map" class="w-full h-full"></div>
        </div>
    </MainLayout>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';
import { onMounted } from 'vue';
import L from 'leaflet';

onMounted(() => {
    const map = L.map('map').setView([51.505, -0.09], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution:
            '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    }).addTo(map);

    L.marker([51.505, -0.09])
        .addTo(map)
        .bindPopup('A pretty CSS3 popup.<br> Easily customizable.')
        .openPopup();

    
});
</script>

<style scoped>
.map-container {
    height: 500px;
    width: 100%;
}
</style>
