<template>
    <BaseButton
        customClasses="text-white bg-blue-700"
        ringClasses="focus:ring-4 focus:ring-blue-300"
        hoverClasses="hover:bg-blue-800"
        darkModeClasses="dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
    >
        <slot></slot>
    </BaseButton>
</template>

<script setup>
import BaseButton from './BaseButton.vue';
</script>
