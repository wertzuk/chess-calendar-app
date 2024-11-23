<template>
    <div
        class="p-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 flex flex-col"
    >
        <h5 class="mb-1 text-xl font-bold tracking-tight text-gray-900 dark:text-white">
            {{ tournament.title }}
        </h5>
        <DateRange
            :start="tournament.start_date"
            :end="tournament.end_date"
            class="text-sm"
        ></DateRange>
        <div class="flex flex-wrap gap-2 flex-grow-0 mt-auto">
            <Chip class="flex gap-1" isIconChip="true">
                <IconLocation />
                <span>{{ tournament.city }}</span>
            </Chip>
            <Chip>{{ tournament.chess_type }}</Chip>
            <Chip v-if="tournament.elo_rated">ELO</Chip>
            <Chip v-if="tournament.dwz_rated">DWZ</Chip>
            <Chip v-if="tournament.rapid_elo_rated">Rapid-ELO</Chip>
            <Chip v-if="tournament.blitz_elo_rated">Blitz-ELO</Chip>
        </div>
        <div class="flex justify-between mt-8">
            <LinkButton :href="route('tournament.show', { id: tournament.id })">Mehr</LinkButton>

            <div class="flex gap-2">
                <EditButton
                    :href="route('tournaments.edit', { id: tournament.id })"
                    v-if="tournament.can.edit"
                    >Edit</EditButton
                >
                <form method="post" @submit.prevent="destroy">
                    <DeleteButton
                        v-if="tournament.can.delete"
                        @click="destroy"
                        data-modal-target="popup-modal"
                        data-modal-toggle="popup-modal"
                        ><IconDelete></IconDelete
                    ></DeleteButton>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import { onMounted } from 'vue';
import Chip from '@/Components/Common/Chip.vue';
import IconLocation from '@/Components/Icons/IconLocation.vue';
import LinkButton from '@/Components/Buttons/LinkButton.vue';
import IconEdit from '@/Components/Icons/IconEdit.vue';
import IconDelete from '@/Components/Icons/IconDelete.vue';
import PrimaryButton from './Buttons/PrimaryButton.vue';
import { initFlowbite } from 'flowbite';
import { useForm } from '@inertiajs/vue3';
import DateRange from './Common/DateRange.vue';
import EditButton from './Buttons/EditButton.vue';
import DeleteButton from './Buttons/DeleteButton.vue';

const props = defineProps(['tournament']);
const form = useForm({});

function destroy() {
    const submitBtn = document.getElementById('confirm');
    submitBtn.addEventListener('click', () => {
        form.delete(route('tournaments.destroy', { id: props.tournament.id }));
    });
}

onMounted(() => {
    initFlowbite();
});
</script>
