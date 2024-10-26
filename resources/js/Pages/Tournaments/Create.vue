<template>
    <MainLayout>
        <SecondaryHeading class="text-center mb-6">Turnier erstellen</SecondaryHeading>

        <FormTournament @submitForm="submit"></FormTournament>
    </MainLayout>
</template>

<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import SecondaryHeading from '@/Components/Common/SecondaryHeading.vue';
import FormTournament from '@/Components/Form/FormTournament.vue';

function submit(form) {
    form.post(route('tournaments.store'));
}

let props = defineProps(['errors']);
</script>
