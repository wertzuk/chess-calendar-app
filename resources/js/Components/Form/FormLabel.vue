<template>
    <label :for="key" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
        ><slot></slot
    ></label>
</template>

<script setup lang="ts">
defineProps<{
    key: any;
}>();
</script>
