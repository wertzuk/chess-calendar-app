<template>
    <MainLayout>
        <FormInput modelValue="test" type="email" v-model="test" />
        {{ test }}
    </MainLayout>
</template>

<script setup>
import { ref } from 'vue';
import FormInput from '@/Components/Form/FormInput.vue';
import MainLayout from '@/Layouts/MainLayout.vue';
const form = ref({});

const test = ref(null);
</script>
