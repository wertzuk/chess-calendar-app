<template>
    <BaseButton
        customClasses="text-white bg-blue-700 inline-flex items-center"
        ringClasses="focus:ring-4 focus:ring-blue-300"
        hoverClasses="hover:bg-blue-800"
        darkModeClasses="dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
    >
        <svg
            class="w-4 h-4 me-2 text-gray-800 dark:text-white"
            aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg"
            width="20"
            height="20"
            fill="none"
            viewBox="0 0 24 24"
        >
            <path
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M5 12h14m-7 7V5"
            />
        </svg>

        <slot></slot>
    </BaseButton>
</template>

<script setup>
import BaseButton from './BaseButton.vue';
</script>
