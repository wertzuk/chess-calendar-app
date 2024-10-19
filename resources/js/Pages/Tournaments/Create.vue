<template>
    <MainLayout>
        <!-- <h1>Turnier erstellen</h1> -->
        <form
            :action="route('tournaments.store')"
            method="post"
            class="flex flex-col gap-4"
        >
            <input type="hidden" name="_token" :value="page.props.csrf_token" />

            <FormInput fieldKey="title">Turnier</FormInput>
            <FormDatePicker modelValue="12-12-2024" fieldKey="start_date" />
            <FormInput fieldKey="time_control">Zeitkontrolle</FormInput>
            <FormInput fieldKey="street">Straße</FormInput>
            <FormInput fieldKey="plz">PLZ</FormInput>
            <FormInput fieldKey="city">Ort</FormInput>
            <FormInput fieldKey="time_control">Zeitkontrolle</FormInput>

            <PrimaryButton class="mt-8">Erstellen</PrimaryButton>
        </form>
    </MainLayout>
</template>

<script setup>
import { ref } from 'vue';
import FormInput from '@/Components/Form/FormInput.vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue';
import FormDatePicker from '@/Components/Form/FormDatePicker.vue';
import { usePage } from '@inertiajs/vue3';
const form = ref({});

const page = usePage();

function submit() {}
</script>
