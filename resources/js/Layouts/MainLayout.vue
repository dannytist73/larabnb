<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import { route } from "ziggy";
import { computed } from "vue";

const page = usePage();
const flashSuccess = computed(() => page.props.flash.success);

const user = computed(() => page.props.user);
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
                        class="text-gray-500"
                        :href="route('seller.listing.index')"
                        >{{ user.name }}</Link
                    >
                    <Link :href="route('listing.create')" class="btn-primary"
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
