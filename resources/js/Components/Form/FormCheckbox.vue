<template>
    <div class="flex items-center mb-4">
        <input
            :id="fieldKey"
            type="checkbox"
            :name="fieldKey"
            :checked="modelValue"
            :value="currentValue"
            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
            @change="currentValue ^= 1"
        />
        <label
            :for="fieldKey"
            class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"
        >
            <slot />
        </label>
    </div>
</template>

<script setup>
import { ref } from 'vue';
const props = defineProps({
    fieldKey: String,
    modelValue: Number,
});
const currentValue = ref(props.modelValue);

defineEmits(['update:modelValue']);
</script>

<style lang="scss" scoped></style>
