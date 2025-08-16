<template>
    <Link
        as="div"
        :href="route('tournament.show', { id: tournament.id })"
        class="p-5 bg-white border border-gray-200 rounded-lg shadow md:hover:border-gray-500 dark:bg-gray-800 dark:border-gray-700 md:dark:hover:border-gray-500 duration-200 flex flex-col cursor-pointer"
    >
        <div class="flex justify-between gap-2 relative">
            <h2 class="mb-1 text-xl font-semibold tracking-tight text-gray-900 dark:text-white">
                {{ tournament.title }}
            </h2>
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
                                @click="confirmDeletion"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                            >
                                Löschen
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="py-4">
            <div class="flex gap-2">
                <IconCalendar class="text-black dark:text-white" />
                <DateRange
                    :start="tournament.start_date"
                    :end="tournament.end_date"
                    class="text-sm mb-2 font-light text-gray-700 dark:text-gray-400"
                ></DateRange>
            </div>
            <div class="flex gap-2">
                <IconLocation class="dark:text-gray-400" />
                <span class="text-sm mb-2 font-light text-gray-700 dark:text-gray-400">{{
                    tournament.location.city
                }}</span>
            </div>
        </div>
        <div class="flex flex-wrap gap-2 flex-grow-0 mt-auto">
            <Chip>{{ tournament.chess_type }}</Chip>
            <Chip v-if="tournament.elo_rated">ELO</Chip>
            <Chip v-if="tournament.dwz_rated">DWZ</Chip>
            <Chip v-if="tournament.rapid_elo_rated">Rapid-ELO</Chip>
            <Chip v-if="tournament.blitz_elo_rated">Blitz-ELO</Chip>
        </div>
    </Link>
    <Modal :show="confirmingDeletion" maxWidth="sm">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 text-center">
                Sind Sie sicher?
            </h2>

            <div class="mt-6 cl flex justify-center gap-2">
                <Button
                    variant="secondary"
                    @click="closeModal"
                >
                    Nein
                </Button>

                <Button
                    class="ms-3"
                    variant="danger"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    @click="destroy"
                >
                    Ja
                </Button>
            </div>
        </div>
    </Modal>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import { initFlowbite } from 'flowbite';
import { Link, useForm, router } from '@inertiajs/vue3';
import Chip from '@/Components/Common/Chip.vue';
import Modal from './Common/Modal.vue';
import IconLocation from '@/Components/Icons/IconLocation.vue';
import IconDots from '@/Components/Icons/IconDots.vue';
import DateRange from './Common/DateRange.vue';
import IconCalendar from './Icons/IconCalendar.vue';
import Button from '@/Components/Buttons/Button.vue';

const props = defineProps(['tournament']);
const form = useForm({});
const confirmingDeletion = ref(false);

const confirmDeletion = () => {
    confirmingDeletion.value = true;
};

const closeModal = () => (confirmingDeletion.value = false);

const destroy = () => {
    form.delete(route('tournaments.destroy', props.tournament.id), {
        onSuccess: () => {
            closeModal();
            router.visit(route('home'), {
                only: ['tournaments'], // Only reload the tournaments data
                preserveScroll: true,
            });
        },
        // onFinish: () => location.reload(),
    });
};

onMounted(() => {
    initFlowbite();
});
</script>
