<template>
    <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
        <dt class="text-sm/6 font-medium text-gray-900 dark:text-white">
            <slot name="label">Default Label</slot>
        </dt>
        <dd class="mt-1 text-sm/6 text-gray-500 dark:text-gray-400 sm:col-span-2 sm:mt-0">
            <slot name="value">Default Value</slot>
        </dd>
    </div>
</template>
