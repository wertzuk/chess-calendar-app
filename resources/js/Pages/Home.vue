<script setup>
import Card from '@/Components/Card.vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Home" />

    <MainLayout>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800"
                >
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <p v-if="$page.props.auth.user">You're logged in!</p>
                        <p v-else>Hello guest!</p>
                    </div>
                </div>
                <div class="mt-8">
                    <Card />
                </div>
            </div>
        </div>
    </MainLayout>
</template>
