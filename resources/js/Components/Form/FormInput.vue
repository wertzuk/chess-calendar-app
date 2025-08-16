<template>
    <div class="mb-6 w-full">
        <FormLabel :target="name">{{label}}</FormLabel>
        <input
            type="text"
            :id="name"
            :name="name"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white/10 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            @input="$emit('update:modelValue', $event.target.value)"
            :value="props.modelValue"
            v-bind="$attrs"
        />
        <p class="mt-2 text-sm text-red-600 dark:text-red-500" v-if="error">
            {{ error }}
        </p>
    </div>
</template>

<script setup>
import FormLabel from './FormLabel.vue';
// Don't apply fallthrough attributes to root element
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


</script>
