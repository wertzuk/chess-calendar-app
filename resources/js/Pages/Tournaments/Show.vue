<template>
    <MainLayout>
        <SecondaryHeading class="text-center mb-6">{{ tournament.title }}</SecondaryHeading>
        <div>
            <DateRange :start="tournament.start_date" :end="tournament.end_date" />
        </div>
        <LinkButton class="mt-8" href="/">Zurück</LinkButton>

        {{ tournament }}
    </MainLayout>
</template>

<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import LinkButton from '@/Components/Buttons/LinkButton.vue';
import SecondaryHeading from '@/Components/Common/SecondaryHeading.vue';
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import DateRange from '@/Components/Common/DateRange.vue';

const { tournament } = defineProps({ tournament: Object });
</script>
