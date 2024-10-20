<template>
    <MainLayout>
        <!-- Display errors -->
        <div
            v-if="Object.keys(errors).length"
            class="alert alert-danger text-white"
        >
            {{ errors }}
        </div>
        <!-- <h1>Turnier erstellen</h1> -->
        <form
            :action="route('tournaments.store')"
            method="post"
            class="max-w-lg mx-auto"
        >
            <input type="hidden" name="_token" :value="page.props.csrf_token" />

            <FormInput fieldKey="title">Turnier</FormInput>
            <FormRow>
                <FormInput fieldKey="city">Ort</FormInput>
                <FormSelect
                    fieldKey="chess_type"
                    :options="['Klassisch', 'Schnellschach', 'Blitz']"
                    >Form</FormSelect
                >
            </FormRow>
            <FormRow>
                <FormDatePicker fieldKey="start_date" required
                    >Startdatum</FormDatePicker
                >
                <FormDatePicker fieldKey="end_date" required
                    >Enddatum</FormDatePicker
                >
            </FormRow>
            <FormRow class="mb-10">
                <FormInput fieldKey="time_control" required
                    >Zeitkontrolle</FormInput
                >
                <FormInput fieldKey="number_of_rounds" type="number"
                    >Anzahl Runden</FormInput
                >
            </FormRow>
            <FormRow>
                <FormInput fieldKey="street">Straße</FormInput>
                <FormInput fieldKey="plz">PLZ</FormInput>
            </FormRow>
            <FormInput fieldKey="organizer">Ausrichter</FormInput>

            <FormCheckbox fieldKey="elo_rated">ELO Auswertung</FormCheckbox>
            <FormCheckbox fieldKey="dwz_rated">DWZ Auswertung</FormCheckbox>
            <FormCheckbox fieldKey="rapid_elo_rated"
                >Rapid ELO Auswertung</FormCheckbox
            >
            <FormCheckbox fieldKey="blitz_elo_rated"
                >Blitz ELO Auswertung</FormCheckbox
            >
            <FormInput type="url" fieldKey="chess_results_link"
                >Chess-Results Link</FormInput
            >
            <FormInput type="url" fieldKey="website_link"
                >Link zur Webseite</FormInput
            >
            <FormInput type="url" fieldKey="announcement_link"
                >Link zur Ausschreibung</FormInput
            >

            <PrimaryButton class="mt-8">Erstellen</PrimaryButton>
        </form>
    </MainLayout>
</template>

<script setup>
import { ref } from 'vue';
import { usePage } from '@inertiajs/vue3';
import FormInput from '@/Components/Form/FormInput.vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue';
import FormDatePicker from '@/Components/Form/FormDatePicker.vue';
import FormSelect from '@/Components/Form/FormSelect.vue';
import FormCheckbox from '@/Components/Form/FormCheckbox.vue';
import FormRow from '@/Components/Form/FormRow.vue';

const page = usePage();

let props = defineProps(['errors']);
</script>
