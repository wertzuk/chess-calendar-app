<template>
    <MainLayout class="text-center">
        <SecondaryHeading class="text-center mb-6">{{ tournament.title }}</SecondaryHeading>
        <DateRange :start="tournament.start_date" :end="tournament.end_date" />
        <!-- <LinkButton class="mt-8" href="/">Zurück</LinkButton> -->
        <div class="max-w-7xl">
            <div class="flex gap-2">
                <Chip>{{ tournament.chess_type }}</Chip>
                <Chip v-if="tournament.elo_rated">ELO-Auswertung</Chip>
                <Chip v-if="tournament.dwz_rated">DWZ-Auswertung</Chip>
                <Chip v-if="tournament.rapid_elo_rated">Rapid-ELO-Auswertung</Chip>
                <Chip v-if="tournament.blitz_elo_rated">Blitz-ELO-Auswertung</Chip>
            </div>
            <div>
                <span>{{ tournament.street }} - </span>
                <span>{{ tournament.plz }} - </span>
                <span>{{ tournament.city }}</span>
            </div>
            <div>{{ tournament.time_control }}</div>
            <div>
                <span>{{ tournament.number_of_rounds }}</span>
                <span>{{ tournament.format }}</span>
            </div>
            <div>
                <a
                    :href="tournament.chess_results_link"
                    target="_blank"
                    class="text-white"
                    v-if="tournament.chess_results_link"
                    >Chess-Results</a
                >
                <a
                    :href="tournament.website_link"
                    target="_blank"
                    class="text-white"
                    v-if="tournament.website_link"
                    >Webseite</a
                >
                <a
                    :href="tournament.announcement_link"
                    target="_blank"
                    class="text-white"
                    v-if="tournament.announcement_link"
                    >Ausschreibung</a
                >
            </div>
        </div>

        <pre class="text-white text-left">
            {{ tournament }}
        </pre>
    </MainLayout>
</template>

<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import LinkButton from '@/Components/Buttons/LinkButton.vue';
import SecondaryHeading from '@/Components/Common/SecondaryHeading.vue';
import DateRange from '@/Components/Common/DateRange.vue';
import Chip from '@/Components/Common/Chip.vue';

const { tournament } = defineProps({ tournament: Object });
</script>
