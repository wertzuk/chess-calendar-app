<template>
    <form method="post" @submit.prevent="handleSubmit" class="max-w-2xl mx-auto">
        <FormInput
            label="Turnier"
            v-model="form.title"
            name="title"
            :error="form.errors.title"
            required
            maxlength="100"
        />
        <FormRow>
            <FormInput
                label="Straße"
                v-model="form.street"
                name="street"
                :error="form.errors.street"
                maxlength="50"
            />
            <FormInput label="PLZ" v-model="form.plz" name="plz" :error="form.errors.plz" maxlength="7" />
        </FormRow>
        <FormInput
            label="Ort"
            v-model="form.city"
            name="city"
            :error="form.errors.city"
            required
            maxlength="50"
        />

        <FormRow id="date-range-picker">
            <FormDatePicker

                v-model="form.start_date"
                name="start_date"
                required
                :error="form.errors.start_date"
                label="Startdatum"
            />
            <FormDatePicker
                v-model="form.end_date"
                label="Enddatum"
                name="end_date"
                :error="form.errors.end_date"
            />
        </FormRow>
        <FormRow class="">
            <FormInput
                label="Anzahl Runden"
                v-model="form.number_of_rounds"
                name="number_of_rounds"
                type="number"
                min="0"
                max="100"
                :error="form.errors.number_of_rounds"
            />
            <FormSelect
                label="Form"
                v-model="form.chess_type"
                name="chess_type"
                :options="['Klassisch', 'Schnellschach', 'Blitz']"
                required
            />
        </FormRow>
        <FormInput
            label="Zeitkontrolle"
            v-model="form.time_control"
            name="time_control"
            required
            :error="form.errors.time_control"
            maxlength="200"
        />
        <FormRow>
            <FormCheckbox v-model="form.elo_rated" name="elo_rated">
                ELO Auswertung
            </FormCheckbox>
            <FormCheckbox v-model="form.dwz_rated" name="dwz_rated">
                DWZ Auswertung
            </FormCheckbox>
        </FormRow>
        <FormRow>
            <FormCheckbox v-model="form.rapid_elo_rated" name="rapid_elo_rated">
                Rapid ELO Auswertung
            </FormCheckbox>
            <FormCheckbox v-model="form.blitz_elo_rated" name="blitz_elo_rated">
                Blitz ELO Auswertung
            </FormCheckbox>
        </FormRow>
        <FormInput
            label="Chess-Results Link"
            type="url"
            v-model="form.chess_results_link"
            name="chess_results_link"
            :error="form.errors.chess_results_link"
        />
        <FormInput
            label="Link zur Webseite"
            type="url"
            v-model="form.website_link"
            name="website_link"
            :error="form.errors.website_link"
        />
        <FormInput
            label="Link zur Ausschreibung"
            type="url"
            v-model="form.announcement_link"
            name="announcement_link"
            :error="form.errors.announcement_link"
        />

        <div class="flex justify-between">
            <Button as="Link" variant="secondary" class="mt-8" href="/">Zurück</Button>
            <Button class="mt-8" v-if="isCreate"
            >Erstellen
            </Button
            >
            <Button class="mt-8" v-else>Speichern</Button>
        </div>
    </form>
</template>

<script setup>
import { ref, defineEmits, computed, onMounted } from 'vue';
import { DateRangePicker } from 'flowbite-datepicker';
import { useForm } from '@inertiajs/vue3';
import { convertToGermanDate } from '@/helpers';
import FormInput from '@/Components/Form/FormInput.vue';
import FormDatePicker from '@/Components/Form/FormDatePicker.vue';
import FormSelect from '@/Components/Form/FormSelect.vue';
import FormCheckbox from '@/Components/Form/FormCheckbox.vue';
import FormRow from '@/Components/Form/FormRow.vue';
import Button from '@/Components/Buttons/Button.vue';

const { errors, tournament } = defineProps({
    errors: Array,
    tournament: { type: Object, required: false, default: () => ({}) }
});

const isCreate = computed(() => Object.keys(tournament).length === 0);

const form = useForm({
    title: tournament.title,
    city: tournament.location?.city,
    chess_type: tournament.chess_type ?? 'Klassisch',
    start_date: convertToGermanDate(tournament?.start_date),
    end_date: convertToGermanDate(tournament?.end_date),
    time_control: tournament.time_control,
    number_of_rounds: tournament.number_of_rounds,
    street: tournament.location?.street,
    plz: tournament.location?.plz,
    organizer: tournament.organizer,
    prize_fund: tournament.prize_fund,
    elo_rated: tournament.elo_rated,
    dwz_rated: tournament.dwz_rated,
    blitz_elo_rated: tournament.blitz_elo_rated,
    rapid_elo_rated: tournament.rapid_elo_rated,
    chess_results_link: tournament.chess_results_link,
    website_link: tournament.website_link,
    announcement_link: tournament.announcement_link
});
console.log(form);

onMounted(() => {
    const dateInput = document.getElementById('date-range-picker');

    const options = {
        autohide: true,
        format: 'dd.mm.yyyy'
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
