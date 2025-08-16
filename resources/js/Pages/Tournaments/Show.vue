<template>
    <Head :title="tournament.title" />

    <MainLayout>
        <div class="max-w-2xl mx-auto">
            <SecondaryHeading class="mb-12">{{ tournament.title }}</SecondaryHeading>

            <dl class="divide-y divide-gray-400 dark:divide-gray-700">
                <DescriptionListItem>
                    <template #label>Datum</template>
                    <template #value
                        ><DateRange :start="tournament.start_date" :end="tournament.end_date"
                    /></template>
                </DescriptionListItem>
                <DescriptionListItem>
                    <template #label>Zeitkontrolle</template>
                    <template #value
                        >{{ tournament.time_control }} ({{ tournament.chess_type }})</template
                    >
                </DescriptionListItem>
                <DescriptionListItem>
                    <template #label>Adresse</template>
                    <template #value
                        ><span v-if="tournament.location.street">{{ tournament.location.street }},</span>
                        <span v-if="tournament.location.plz">{{ tournament.location.plz }}</span>
                        {{ tournament.location.city }}</template
                    >
                </DescriptionListItem>
                <DescriptionListItem v-if="tournament.prize_fund">
                    <template #label>Preisfonds</template>
                    <template #value>{{ tournament.prize_fund }}</template>
                </DescriptionListItem>
                <DescriptionListItem v-if="tournament.number_of_rounds">
                    <template #label>Runden</template>
                    <template #value>{{ tournament.number_of_rounds }}</template>
                </DescriptionListItem>
                <DescriptionListItem v-if="isRated">
                    <template #label>Auswertung</template>
                    <template #value
                        ><div class="flex gap-2">
                            {{ formattedRatings }}
                        </div>
                    </template>
                </DescriptionListItem>
                <DescriptionListItem v-if="hasLinks">
                    <template #label>Links</template>
                    <template #value>
                        <div class="mt-4 sm:mt-0 flex flex-wrap">
                            <Button
                                v-for="link in availableLinks"
                                :key="link.label"
                                :href="link.url"
                                as="a"
                                target="_blank"
                                variant="secondary"
                            >
                                {{ link.label }}
                            </Button>
                        </div>
                    </template>
                </DescriptionListItem>
            </dl>
            <Button as="Link" class="mt-16" href="/">Zurück</Button>
        </div>
    </MainLayout>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';

import MainLayout from '@/Layouts/MainLayout.vue';
import SecondaryHeading from '@/Components/Common/SecondaryHeading.vue';
import DateRange from '@/Components/Common/DateRange.vue';
import DescriptionListItem from '@/Components/DescriptionList/DescriptionListItem.vue';
import Button from '@/Components/Buttons/Button.vue';

const { tournament } = defineProps({ tournament: Object });

// Computed property to generate a list of available links
const availableLinks = computed(() => {
    const links = [];
    if (tournament.chess_results_link) {
        links.push({ label: 'Chess-Results', url: tournament.chess_results_link });
    }
    if (tournament.announcement_link) {
        links.push({ label: 'Ausschreibung', url: tournament.announcement_link });
    }
    if (tournament.website_link) {
        links.push({ label: 'Turnierseite', url: tournament.website_link });
    }
    return links;
});

// Computed property to generate a comma-separated string of ratings
const formattedRatings = computed(() => {
    const ratings = [];
    if (tournament.elo_rated) ratings.push('ELO');
    if (tournament.dwz_rated) ratings.push('DWZ');
    if (tournament.blitz_elo_rated) ratings.push('Blitz-ELO');
    if (tournament.rapid_elo_rated) ratings.push('Rapid-ELO');
    return ratings.join(', ');
});

const hasLinks = computed(() => availableLinks.value.length > 0);
const isRated = computed(() => formattedRatings.value.length > 0);
</script>
