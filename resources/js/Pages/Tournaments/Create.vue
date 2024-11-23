<template>
    <Head title="Turnier erstellen" />

    <MainLayout>
        <SecondaryHeading class="text-center mb-6">Turnier erstellen</SecondaryHeading>

        <FormTournament @submitForm="submit"></FormTournament>
    </MainLayout>
</template>

<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import SecondaryHeading from '@/Components/Common/SecondaryHeading.vue';
import FormTournament from '@/Components/Form/FormTournament.vue';
import { convertToISODate } from '@/helpers';
import { Head } from '@inertiajs/vue3';

function submit(form) {
    form.transform((data) => ({
        ...data,
        start_date: convertToISODate(data.start_date),
        end_date: convertToISODate(data.end_date),
    })).post(route('tournaments.store'));
}

let props = defineProps(['errors']);
</script>
