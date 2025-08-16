<script setup>
import { ref } from 'vue';
import Dropdown from '@/Components/Menu/MenuDropdown.vue';
import DropdownLink from '@/Components/Menu/MenuDropdownLink.vue';
import NavLink from '@/Components/Menu/MenuNavLink.vue';
import ResponsiveNavLink from '@/Components/Menu/MenuNavLinkResponsive.vue';
import { Link } from '@inertiajs/vue3';
import LinkButton from '@/Components/Buttons/LinkButton.vue';
import IconLight from '@/Components/Icons/IconLight.vue';
import IconDark from '@/Components/Icons/IconDark.vue';
import SecondaryButton from '@/Components/Buttons/SecondaryButton.vue';

const showingNavigationDropdown = ref(false);
const isDark = ref(document.documentElement.classList.contains('dark'));

function toggleTheme() {
    isDark.value = !isDark.value;
    document.documentElement.classList.toggle('dark');
    localStorage.setItem('theme', isDark.value ? 'dark' : 'light');
}
</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900 flex flex-col">
            <nav class="border-b border-gray-100 bg-white dark:border-gray-700 dark:bg-gray-800">
                <!-- Primary Navigation Menu -->
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex h-16 justify-between">
                        <div class="flex">
                            <!-- Navigation Links -->
                            <div class="hidden sm:-my-px sm:flex gap-8">
                                <NavLink :href="route('home')" :active="route().current('home')">
                                    Home
                                </NavLink>
                                <NavLink :href="route('map')" :active="route().current('map')">
                                    Map
                                </NavLink>
                            </div>
                        </div>

                        <div class="hidden sm:ms-6 sm:flex sm:items-center">
                            <!-- Settings Dropdown -->
                            <div class="relative ms-3 flex gap-4 items-center">
                                <SecondaryButton
                                    class="border-none focus:ring-0"
                                    @click="toggleTheme"
                                >
                                    <IconLight v-if="isDark" />
                                    <IconDark v-else />
                                </SecondaryButton>

                                <LinkButton
                                    :href="route('tournaments.create')"
                                    preserve-scroll
                                    as="button"
                                    class="sm:block"
                                    v-if="$page.props.auth.user"
                                    >Turnier erstellen</LinkButton
                                >
                                <Dropdown align="right" width="48" v-if="$page.props.auth.user">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none dark:bg-gray-800 dark:text-gray-400 dark:hover:text-gray-300"
                                            >
                                                {{ $page.props.auth.user.name }}

                                                <svg
                                                    class="-me-0.5 ms-2 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <DropdownLink :href="route('profile.edit')">
                                            Profil
                                        </DropdownLink>
                                        <DropdownLink
                                            :href="route('logout')"
                                            method="post"
                                            as="button"
                                        >
                                            Log Out
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                                <div v-else>
                                    <Link
                                        :href="route('login')"
                                        class="rounded-md px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none dark:bg-gray-800 dark:text-gray-400 dark:hover:text-gray-300"
                                    >
                                        Log in
                                    </Link>

                                    <Link
                                        :href="route('register')"
                                        class="rounded-md px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none dark:bg-gray-800 dark:text-gray-400 dark:hover:text-gray-300"
                                    >
                                        Registrieren
                                    </Link>
                                </div>
                            </div>
                        </div>

                        <div class="sm:hidden flex items-center gap-2">
                            <SecondaryButton
                                class="border-none focus:ring-0 px-2"
                                @click="toggleTheme"
                            >
                                <IconLight v-if="isDark" />
                                <IconDark v-else />
                            </SecondaryButton>
                            <LinkButton
                                :href="route('tournaments.create')"
                                preserve-scroll
                                as="button"
                                v-if="$page.props.auth.user"
                                >Turnier erstellen</LinkButton
                            >

                            <!-- Hamburger -->
                            <div class="-me-2 flex items-center">
                                <button
                                    @click="showingNavigationDropdown = !showingNavigationDropdown"
                                    class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none dark:text-gray-500 dark:hover:bg-gray-900 dark:hover:text-gray-400 dark:focus:bg-gray-900 dark:focus:text-gray-400"
                                >
                                    <svg
                                        class="h-6 w-6"
                                        stroke="currentColor"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            :class="{
                                                hidden: showingNavigationDropdown,
                                                'inline-flex': !showingNavigationDropdown,
                                            }"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M4 6h16M4 12h16M4 18h16"
                                        />
                                        <path
                                            :class="{
                                                hidden: !showingNavigationDropdown,
                                                'inline-flex': showingNavigationDropdown,
                                            }"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"
                                        />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div
                    :class="{
                        block: showingNavigationDropdown,
                        hidden: !showingNavigationDropdown,
                    }"
                    class="sm:hidden"
                >
                    <div class="space-y-1 pb-3 pt-2">
                        <ResponsiveNavLink :href="route('home')" :active="route().current('home')">
                            Home
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('map')" :active="route().current('map')">
                            Map
                        </ResponsiveNavLink>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="border-t border-gray-200 pb-1 pt-4 dark:border-gray-600">
                        <div class="px-4">
                            <div class="text-base font-medium text-gray-800 dark:text-gray-200">
                                {{ $page.props.auth.user?.name }}
                            </div>
                            <div class="text-sm font-medium text-gray-500">
                                {{ $page.props.auth.user?.email }}
                            </div>
                        </div>

                        <div class="mt-3 space-y-1" v-if="$page.props.auth.user">
                            <ResponsiveNavLink :href="route('profile.edit')">
                                Profil
                            </ResponsiveNavLink>
                            <ResponsiveNavLink :href="route('logout')" method="post" as="button">
                                Log Out
                            </ResponsiveNavLink>
                        </div>
                        <div class="mt-3 space-y-1" v-else>
                            <ResponsiveNavLink :href="route('login')"> Login </ResponsiveNavLink>
                            <ResponsiveNavLink :href="route('register')" as="button">
                                Regististrieren
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <main class="relative grow">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12">
                    <slot />
                </div>
            </main>
        </div>
    </div>
</template>
