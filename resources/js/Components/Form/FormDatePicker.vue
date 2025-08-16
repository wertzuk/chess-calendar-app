<template>
    <div class="w-full">
        <FormLabel :target="name" :for="name">{{label}}</FormLabel>
        <div class="relative max-w-sm mb-6 text-gray-900 dark:text-white">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                <IconCalendar />
            </div>
            <input
                :value="modelValue"
                :id="name"
                @changeDate="$emit('update:modelValue', $event.target.value)"
                type="text"
                class="bg-gray-50 border border-gray-300 text-base rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-white/10 dark:border-gray-600 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Select date"
            />
        </div>

        <p class="-mt-2 text-sm text-red-600 dark:text-red-500" v-if="error">
            {{ error }}
        </p>
    </div>
</template>

<script setup>
import FormLabel from './FormLabel.vue';
import IconCalendar from '../Icons/IconCalendar.vue';

defineOptions({
    inheritAttrs: false,
});
const props = defineProps({
    modelValue: {
        required: true,
    },
    label: {
        type: String,
        required: true,
        default: '',
    },
    name: {
        type: String,
        required: true
    },
    error: {
        type: Object,
        required: false
    }
});

defineEmits(['update:modelValue']);
</script>
