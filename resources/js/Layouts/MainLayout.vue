<template>
    <header
        class="border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 w-full"
    >
        <div class="container mx-auto">
            <nav class="p-4 flex items-center justify-between">
                <div class="text-lg font-medium">
                    <Link :href="route('listing.index')">Listings</Link>
                </div>
                <div class="text-xl text-indigo-600 dark:text-indigo-300">
                    <Link :href="route('listing.index')">LaraBnb</Link>
                </div>
                <div class="text-lg">
                    <Link :href="route('listing.create')" class="btn-primary"
                        >+ Create New Listing</Link
                    >
                </div>
            </nav>
        </div>
    </header>

    <main class="container mx-auto p-4">
        <div
            v-if="flashSuccess"
            class="mb-4 border rounded-md shadow-sm border-green-200 dark:border-green-800 bg-green dark:bg-green-900 p-1"
        >
            {{ flashSuccess }}
        </div>
        <slot>Default</slot>
    </main>
</template>

<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import { computed, ref } from "vue";

const page = usePage();

const flashSuccess = computed(() => page.props.flash.success);
</script>
