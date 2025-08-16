<script setup>
import InputError from '@/Components/Auth/InputError.vue';
import InputLabel from '@/Components/Auth/InputLabel.vue';
import Modal from '@/Components/Common/Modal.vue';
import TextInput from '@/Components/Auth/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';
import Button from '@/Components/Buttons/Button.vue';

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: '',
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;

    nextTick(() => passwordInput.value.focus());
};

const deleteUser = () => {
    form.delete(route('profile.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;

    form.clearErrors();
    form.reset();
};
</script>

<template>
    <section class="space-y-6">
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Account löschen</h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Sobald Ihr Konto gelöscht wurde, werden alle damit verbundenen Ressourcen und Daten
                dauerhaft gelöscht. Bevor Sie Ihr Konto löschen, laden Sie bitte alle Daten oder
                Informationen herunter, die Sie behalten möchten.
            </p>
        </header>

        <Button variant="danger" @click="confirmUserDeletion">Account Löschen</Button>

        <Modal :show="confirmingUserDeletion" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    Are you sure you want to delete your account?
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Sobald Ihr Konto gelöscht wurde, werden alle damit verbundenen Ressourcen und
                    Daten dauerhaft gelöscht. Bitte geben Sie Ihr Passwort ein, um zu bestätigen,
                    dass Sie Ihr Konto endgültig löschen möchten.
                </p>

                <div class="mt-6">
                    <InputLabel for="password" value="Password" class="sr-only" />

                    <TextInput
                        id="password"
                        ref="passwordInput"
                        v-model="form.password"
                        type="password"
                        class="mt-1 block w-3/4"
                        placeholder="Password"
                        @keyup.enter="deleteUser"
                    />

                    <InputError :message="form.errors.password" class="mt-2" />
                </div>

                <div class="mt-6 flex justify-end">
                    <Button variant="secondary" @click="closeModal"> Abbrechen </Button>

                    <Button
                        variant="danger"
                        class="ms-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="deleteUser"
                    >
                        Account löschen
                    </Button>
                </div>
            </div>
        </Modal>
    </section>
</template>
