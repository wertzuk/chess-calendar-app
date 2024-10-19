<template>
    <div>
        <label
            for="name"
            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
            >Label</label
        >
        <input
            type="text"
            id="name"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            @input="$emit('update:modelValue', $event.target.value)"
            :value="props.modelValue"
            v-bind="$attrs"
        />
    </div>
</template>

<script setup>
// Don't apply fallthrough attributes to root element
defineOptions({
    inheritAttrs: false,
});
const props = defineProps(['modelValue', 'name']);
</script>
