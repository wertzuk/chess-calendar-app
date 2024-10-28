<template>
    <div class="w-full">
        <FormLabel :for="fieldKey"><slot></slot></FormLabel>
        <div class="relative max-w-sm mb-6">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                <svg
                    class="w-4 h-4 text-gray-500 dark:text-gray-400"
                    aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                >
                    <path
                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"
                    />
                </svg>
            </div>
            <input
                :value="modelValue"
                :name="fieldKey"
                :id="fieldKey"
                @changeDate="$emit('update:modelValue', $event.target.value)"
                type="text"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Select date"
            />
        </div>

        <p class="-mt-2 text-sm text-red-600 dark:text-red-500" v-if="error">
            {{ error }}
        </p>
    </div>
</template>

<script setup>
import { onBeforeUnmount, onMounted, ref } from 'vue';
import { Datepicker } from 'flowbite';
import FormLabel from './FormLabel.vue';

defineOptions({
    inheritAttrs: false,
});
const props = defineProps(['modelValue', 'fieldKey', 'error']);
const datePicker = ref(null);

onMounted(() => {
    const dateInput = document.getElementById(props.fieldKey);
    if (dateInput) {
        datePicker.value = new Datepicker(dateInput, {
            autohide: true,
            format: 'yyyy-mm-dd',
        });
    }
});

onBeforeUnmount(() => {
    if (datePicker.value) {
        datePicker.value.hide();
    }
});
defineEmits(['update:modelValue']);
</script>
