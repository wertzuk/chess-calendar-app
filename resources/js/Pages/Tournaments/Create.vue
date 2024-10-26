<template>
    <MainLayout>
        <!-- {{ form.errors }} -->
        <SecondaryHeading class="text-center mb-6">Turnier erstellen</SecondaryHeading>
        <!-- <LinkButton href="/">Zurück</LinkButton> -->

        <form method="post" @submit.prevent="submit" class="max-w-lg mx-auto">
            <FormInput
                v-model="form.title"
                fieldKey="title"
                :error="form.errors.title"
                required
                maxlength="100"
                >Turnier</FormInput
            >
            <FormRow>
                <FormInput
                    v-model="form.city"
                    fieldKey="city"
                    :error="form.errors.city"
                    required
                    maxlength="50"
                    >Ort</FormInput
                >
                <FormSelect
                    v-model="form.chess_type"
                    fieldKey="chess_type"
                    :options="['Klassisch', 'Schnellschach', 'Blitz']"
                    required
                    >Form</FormSelect
                >
            </FormRow>
            <FormRow>
                <FormDatePicker
                    v-model="form.start_date"
                    fieldKey="start_date"
                    required
                    :error="form.errors.start_date"
                    >Startdatum</FormDatePicker
                >
                <FormDatePicker
                    v-model="form.end_date"
                    fieldKey="end_date"
                    :error="form.errors.end_date"
                    >Enddatum</FormDatePicker
                >
            </FormRow>
            <FormRow class="mb-10">
                <FormInput
                    v-model="form.time_control"
                    fieldKey="time_control"
                    required
                    :error="form.errors.time_control"
                    maxlength="50"
                    >Zeitkontrolle</FormInput
                >
                <FormInput
                    v-model="form.number_of_rounds"
                    fieldKey="number_of_rounds"
                    type="number"
                    min="0"
                    max="100"
                    :error="form.errors.number_of_rounds"
                    >Anzahl Runden</FormInput
                >
            </FormRow>
            <FormCollapseButton @click="detailsActive = !detailsActive" :active="detailsActive" />
            <div v-if="detailsActive">
                <FormRow>
                    <FormInput
                        v-model="form.street"
                        fieldKey="street"
                        :error="form.errors.street"
                        maxlength="50"
                        >Straße</FormInput
                    >
                    <FormInput
                        v-model="form.plz"
                        fieldKey="plz"
                        :error="form.errors.plz"
                        maxlength="7"
                        >PLZ</FormInput
                    >
                </FormRow>
                <FormInput
                    v-model="form.organizer"
                    fieldKey="organizer"
                    :error="form.errors.organizer"
                    maxlength="50"
                    >Ausrichter</FormInput
                >
                <FormRow>
                    <FormCheckbox v-model="form.elo_rated" fieldKey="elo_rated"
                        >ELO Auswertung</FormCheckbox
                    >
                    <FormCheckbox v-model="form.dwz_rated" fieldKey="dwz_rated"
                        >DWZ Auswertung</FormCheckbox
                    >
                </FormRow>
                <FormRow>
                    <FormCheckbox v-model="form.rapid_elo_rated" fieldKey="rapid_elo_rated"
                        >Rapid ELO Auswertung</FormCheckbox
                    >
                    <FormCheckbox v-model="form.blitz_elo_rated" fieldKey="blitz_elo_rated"
                        >Blitz ELO Auswertung</FormCheckbox
                    >
                </FormRow>
                <FormInput
                    type="url"
                    v-model="form.chess_results_link"
                    fieldKey="chess_results_link"
                    :error="form.errors.chess_results_link"
                    >Chess-Results Link</FormInput
                >
                <FormInput
                    type="url"
                    v-model="form.website_link"
                    fieldKey="website_link"
                    :error="form.errors.website_link"
                    >Link zur Webseite</FormInput
                >
                <FormInput
                    type="url"
                    v-model="form.announcement_link"
                    fieldKey="announcement_link"
                    :error="form.errors.announcement_link"
                    >Link zur Ausschreibung</FormInput
                >
            </div>

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
import { useForm } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import MainHeading from '@/Components/MainHeading.vue';
import SecondaryHeading from '@/Components/SecondaryHeading.vue';
import LinkButton from '@/Components/Buttons/LinkButton.vue';
import SecondaryButton from '@/Components/Buttons/SecondaryButton.vue';
import FormCollapseButton from '@/Components/Form/FormCollapseButton.vue';

const page = usePage();

const form = useForm({
    title: null,
    city: null,
    chess_type: 'Klassisch',
    start_date: null,
    end_date: null,
    time_control: null,
    number_of_rounds: null,
    street: null,
    plz: null,
    organizer: null,
    elo_rated: 0,
    dwz_rated: 0,
    blitz_elo_rated: 0,
    rapid_elo_rated: 0,
    chess_results_link: null,
    website_link: null,
    announcement_link: null,
});

const detailsActive = ref(false);

function submit() {
    form.post(route('tournaments.store'));
}

let props = defineProps(['errors']);
</script>
