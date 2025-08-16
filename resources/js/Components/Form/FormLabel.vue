<template>
    <label :for="target" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
        ><slot></slot
    ></label>
</template>

<script setup >
defineProps({
    target: {
        type: String,
        required: true
    }
})
</script>
