<template>
    <Link
        as="div"
        :href="route('tournament.show', { id: tournament.id })"
        class="p-4 bg-white border border-gray-200 rounded-lg shadow hover:border-gray-500 dark:bg-gray-800 dark:border-gray-700 dark:hover:border-gray-500 duration-200 flex flex-col cursor-pointer"
        preserve-scroll
    >
        <div class="flex justify-between gap-2 relative">
            <h5 class="mb-1 text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                {{ tournament.title }}
            </h5>
            <div v-if="tournament.can.delete || tournament.can.edit">
                <button
                    :id="`dropdown_${tournament.id}`"
                    :data-dropdown-toggle="`dropdownDots_${tournament.id}`"
                    class="w-10 h-10 flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    @click.stop
                    type="button"
                >
                    <IconDots />
                </button>
                <div
                    :id="`dropdownDots_${tournament.id}`"
                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700 dark:divide-gray-600"
                >
                    <ul
                        class="py-2 text-sm text-gray-700 dark:text-gray-200"
                        @click.stop
                        :aria-labelledby="`dropdown_${tournament.id}`"
                    >
                        <li v-if="tournament.can.edit">
                            <Link
                                :href="route('tournaments.edit', { id: tournament.id })"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                >Bearbeiten</Link
                            >
                        </li>
                        <li v-if="tournament.can.delete">
                            <div
                                href="#"
                                @click="destroy"
                                data-modal-target="popup-modal"
                                data-modal-toggle="popup-modal"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                            >
                                Löschen
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <DateRange
            :start="tournament.start_date"
            :end="tournament.end_date"
            class="text-sm mb-6 font-normal text-gray-700 dark:text-gray-400"
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
    </Link>
</template>

<script setup>
import { onMounted } from 'vue';
import { initFlowbite } from 'flowbite';
import { Link, useForm } from '@inertiajs/vue3';
import Chip from '@/Components/Common/Chip.vue';
import IconLocation from '@/Components/Icons/IconLocation.vue';
import IconDots from '@/Components/Icons/IconDots.vue';
import DateRange from './Common/DateRange.vue';

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
