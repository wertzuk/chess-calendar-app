<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    variant: {
        type: String,
        default: 'primary',
        validator: (value) => ['primary', 'secondary', 'danger', 'success', 'warning'].includes(value)
    },
    size: {
        type: String,
        default: 'sm',
        validator: (value) => ['sm', 'md', 'lg'].includes(value)
    },
    as: {
        type: String,
        default: 'button',
        validator: (value) => ['button', 'a', 'Link'].includes(value)
    }
});

const buttonClasses = computed(() => {
    const base = 'font-medium rounded-lg px-[1.2em] py-[0.6em] focus:outline-none';

    const variants = {
        primary: 'bg-blue-600 text-white hover:bg-blue-700 focus:ring-blue-500',
        secondary: 'bg-gray-600 text-white hover:bg-gray-700 focus:ring-gray-500',
        danger: 'bg-red-600 text-white hover:bg-red-700 focus:ring-red-500',
        success: 'bg-green-600 text-white hover:bg-green-700 focus:ring-green-500',
        warning: 'bg-yellow-500 text-white hover:bg-yellow-600 focus:ring-yellow-500'
    };

    const sizes = {
        sm: 'text-sm',
        md: 'text-base',
        lg: 'text-lg'
    };

    return [base, variants[props.variant], sizes[props.size]].join(' ');
});
</script>

<template>

    <Link
        v-if="as === 'Link'"
        :class="buttonClasses"
        v-bind="$attrs"
    >
        <slot />
    </Link>

    <a
        v-else-if="as === 'a'"
        :class="buttonClasses"
        v-bind="$attrs"
    >
        <slot />
    </a>
    <button
        v-else
        :class="buttonClasses"
    >
        <slot />
    </button>
</template>

