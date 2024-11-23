<template>
    <form method="post" @submit.prevent="handleSubmit" class="max-w-lg mx-auto">
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
        <FormRow id="date-range-picker">
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
        <FormInput
            v-model="form.time_control"
            fieldKey="time_control"
            required
            :error="form.errors.time_control"
            maxlength="100"
            >Zeitkontrolle</FormInput
        >
        <FormRow class="mb-10">
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
                <FormInput v-model="form.plz" fieldKey="plz" :error="form.errors.plz" maxlength="7"
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

        <div class="flex justify-between">
            <LinkButton type="button" class="mt-8" href="/">Zurück</LinkButton>
            <PrimaryButton class="mt-8" v-if="isCreate">Erstellen</PrimaryButton>
            <PrimaryButton class="mt-8" v-else>Speichern</PrimaryButton>
        </div>
    </form>
</template>

<script setup>
import { ref, defineEmits, computed, onMounted } from 'vue';
import { DateRangePicker } from 'flowbite-datepicker';
import { useForm } from '@inertiajs/vue3';
import { convertToGermanDate } from '@/helpers';
import FormInput from '@/Components/Form/FormInput.vue';
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue';
import FormDatePicker from '@/Components/Form/FormDatePicker.vue';
import FormSelect from '@/Components/Form/FormSelect.vue';
import FormCheckbox from '@/Components/Form/FormCheckbox.vue';
import FormRow from '@/Components/Form/FormRow.vue';
import LinkButton from '@/Components/Buttons/LinkButton.vue';
import FormCollapseButton from '@/Components/Form/FormCollapseButton.vue';

const { errors, tournament } = defineProps({
    errors: Array,
    tournament: { type: Object, required: false, default: () => ({}) },
});

const isCreate = computed(() => Object.keys(tournament).length === 0);

const form = useForm({
    title: tournament.title,
    city: tournament.city,
    chess_type: tournament.chess_type ?? 'Klassisch',
    start_date: convertToGermanDate(tournament?.start_date),
    end_date: convertToGermanDate(tournament?.end_date),
    time_control: tournament.time_control,
    number_of_rounds: tournament.number_of_rounds,
    street: tournament.street,
    plz: tournament.plz,
    organizer: tournament.organizer,
    elo_rated: tournament.elo_rated,
    dwz_rated: tournament.dwz_rated,
    blitz_elo_rated: tournament.blitz_elo_rated,
    rapid_elo_rated: tournament.rapid_elo_rated,
    chess_results_link: tournament.chess_results_link,
    website_link: tournament.website_link,
    announcement_link: tournament.announcement_link,
});

onMounted(() => {
    const dateInput = document.getElementById('date-range-picker');

    const options = {
        autohide: true,
        format: 'dd.mm.yyyy',
    };

    if (dateInput) {
        new DateRangePicker(dateInput, options);
    }
});

const detailsActive = ref(false);

const emit = defineEmits(['submitForm']);

// Handle form submission
const handleSubmit = () => {
    emit('submitForm', form);
};
</script>
