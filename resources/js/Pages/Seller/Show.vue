<script setup>
import ListingBike from "@/Components/ListingBike.vue";
import ListingContact from "@/Components/ListingContact.vue";
import ListingDetail from "@/Components/ListingDetail.vue";
import Price from "@/Components/Price.vue";
import Box from "@/Components/UI/Box.vue";
import Offer from "@/Pages/Seller/Show/Components/Offer.vue";

import { Link } from "@inertiajs/vue3";
import { computed } from "vue";

const props = defineProps({
    listing: Object,
});

const hasOffers = computed(() => props.listing.offers.length);
</script>

<template>
    <div class="mb-4">
        <Link :href="route('seller.listing.index')">← Go back to Listings</Link>
    </div>

    <section class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4">
        <Box v-if="!hasOffers" class="flex md:col-span-7 items-center">
            <div class="w-full text-center font-medium text-gray-500">
                No offers
            </div>
        </Box>

        <div v-else class="md:col-span-7 flex flex-col">
            <Offer
                v-for="offer in listing.offers"
                :key="offer.id"
                :offer="offer"
                :listing-price="listing.price"
                class="mb-4"
                :is-sold="listing.sold_at != null"
            ></Offer>
        </div>

        <div class="md:col-span-5">
            <Box>
                <template #header>Basic Info</template>
                <Price :price="listing.price" class="text-2xl font-bold" />
                <ListingBike :listing="listing" class="text-lg" />
                <ListingDetail :listing="listing" class="text-gray-500 mt-4" />
                <ListingContact :listing="listing" class="mt-4" />
            </Box>
        </div>
    </section>
</template>
