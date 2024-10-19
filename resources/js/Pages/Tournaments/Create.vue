<template>
    <MainLayout>
        <form action="">
            <FormInput key="title">Turnier</FormInput>
            <PrimaryButton class="mt-8">Erstellen</PrimaryButton>
        </form>
    </MainLayout>
</template>

<script setup>
import { ref } from 'vue';
import FormInput from '@/Components/Form/FormInput.vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue';
const form = ref({});

const test = ref(null);
</script>
