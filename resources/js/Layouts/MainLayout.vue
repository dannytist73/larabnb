<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import { route } from "ziggy";
import { computed } from "vue";

const page = usePage();
const flashSuccess = computed(() => page.props.flash.success);

const user = computed(() => page.props.user);

const notificationCount = computed(() =>
    Math.min(page.props.user.notificationCount, 9)
);
</script>

<template>
    <header
        class="border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 w-full"
    >
        <div class="container mx-auto">
            <nav class="p-4 flex items-center justify-between">
                <div class="text-lg font-medium">
                    <Link :href="route('listing.index')">Listings</Link>
                </div>
                <div class="text-xl text-gray-600 dark:text-gray-300">
                    <Link :href="route('listing.index')">RideRadar</Link>
                </div>
                <div class="flex items-center gap-4" v-if="user">
                    <Link
                        :href="route('notification.index')"
                        class="text-gray-500 relative pr-2 py-2"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="size-6"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0"
                            />
                        </svg>
                        <div
                            v-if="notificationCount"
                            class="absolute right-0 top-0 w-5 h-5 bg-red-700 dark:bg-red-400 text-white font-medium border border-white dark:border-gray-900 rounded-full text-xs text-center"
                        >
                            {{ notificationCount }}
                        </div>
                    </Link>

                    <Link
                        class="text-gray-500"
                        :href="route('seller.listing.index')"
                        >{{ user.name }}</Link
                    >
                    <Link
                        :href="route('seller.listing.create')"
                        class="btn-primary"
                        >+ New Listing</Link
                    >
                    <div>
                        <Link
                            :href="route('logout')"
                            method="delete"
                            as="button"
                            >Logout</Link
                        >
                    </div>
                </div>
                <div v-else class="flex items-center gap-4">
                    <Link :href="route('user-account.create')">Register</Link>
                    <Link :href="route('login')">Sign-In</Link>
                </div>
            </nav>
        </div>
    </header>

    <main class="container mx-auto p-4 w-full">
        <div
            v-if="flashSuccess"
            class="mb-4 border rounded-md shadow-sm border-green-200 dark:border-green-800 bg-green dark:bg-green-900 p-1"
        >
            {{ flashSuccess }}
        </div>
        <slot>Default</slot>
    </main>
</template>
