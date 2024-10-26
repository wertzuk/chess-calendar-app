<template>
    <MainLayout>
        <SecondaryHeading class="text-center mb-6">Turnier bearbeiten</SecondaryHeading>
        <FormTournament :tournament="tournament" @submitForm="submit"></FormTournament>
    </MainLayout>
</template>

<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import SecondaryHeading from '@/Components/Common/SecondaryHeading.vue';
import FormTournament from '@/Components/Form/FormTournament.vue';
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
const tournament = computed(() => usePage().props.tournament);

function submit(form) {
    form.put(`/tournaments/${tournament.value.id}`);
}

let props = defineProps(['errors']);
</script>
