<template>
    <Head :title="tournament.title" />

    <MainLayout>
        <SecondaryHeading class="text-center mb-6">{{ tournament.title }}</SecondaryHeading>
        <DateRange
            :start="tournament.start_date"
            :end="tournament.end_date"
            class="text-lg text-center"
        />
        <div class="max-w-2xl mx-auto">
            <ul class="py-12 space-y-4 text-left text-gray-500 dark:text-gray-400 mx-auto">
                <ListItem>
                    <IconLocation />
                    <span class="text-lg">{{ tournament.city }}</span>
                </ListItem>
                <ListItem v-if="tournament.time_control"
                    ><IconClock /><span
                        >{{ tournament.time_control }} ({{ tournament.chess_type }})</span
                    ></ListItem
                >
                <ListItem v-if="tournament.number_of_rounds"
                    ><IconNumber /><span>{{ tournament.number_of_rounds }} Runden</span></ListItem
                >
                <ListItem v-if="tournament.elo_rated"
                    ><IconCheckmark /><span>ELO-Auswertung</span></ListItem
                >
                <ListItem v-if="tournament.dwz_rated"
                    ><IconCheckmark /><span>DWZ-Auswertung</span></ListItem
                >
                <ListItem v-if="tournament.rapid_elo_rated"
                    ><IconCheckmark /><span>Rapid-ELO-Auswertung</span></ListItem
                >
                <ListItem v-if="tournament.blitz_elo_rated"
                    ><IconCheckmark /><span>Blitz-ELO-Auswertung</span></ListItem
                >
                <ListItem v-if="tournament.chess_results_link">
                    <ExternalLinkButton :href="tournament.chess_results_link"
                        >Chess-Results Link</ExternalLinkButton
                    >
                </ListItem>
                <ListItem v-if="tournament.website_link">
                    <ExternalLinkButton :href="tournament.website_link"
                        >Link zur Webseite</ExternalLinkButton
                    >
                </ListItem>
                <ListItem v-if="tournament.announcement_link">
                    <ExternalLinkButton :href="tournament.announcement_link"
                        >Link zur Ausschreibung</ExternalLinkButton
                    >
                </ListItem>
            </ul>
            <LinkButton class="mt-16" href="/">Zurück</LinkButton>
        </div>
    </MainLayout>
</template>

<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import LinkButton from '@/Components/Buttons/LinkButton.vue';
import SecondaryHeading from '@/Components/Common/SecondaryHeading.vue';
import DateRange from '@/Components/Common/DateRange.vue';
import ListItem from '@/Components/List/ListItem.vue';
import IconLocation from '@/Components/Icons/IconLocation.vue';
import IconCheckmark from '@/Components/Icons/IconCheckmark.vue';
import IconClock from '@/Components/Icons/IconClock.vue';
import IconNumber from '@/Components/Icons/IconNumber.vue';
import { Head } from '@inertiajs/vue3';
import ExternalLinkButton from '@/Components/Buttons/ExternalLinkButton.vue';

const { tournament } = defineProps({ tournament: Object });
</script>
