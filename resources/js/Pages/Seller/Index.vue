<script setup>
import ListingBike from "@/Components/ListingBike.vue";
import ListingContact from "@/Components/ListingContact.vue";
import ListingDetail from "@/Components/ListingDetail.vue";
import SellerFilters from "@/Pages/Seller/Index/Components/SellerFilters.vue";
import Price from "@/Components/Price.vue";
import Box from "@/Components/UI/Box.vue";
import { Link } from "@inertiajs/vue3";
import Pagination from "@/Components/UI/Pagination.vue";
import { route } from "ziggy";
import EmptyState from "@/Components/UI/EmptyState.vue";

defineProps({
    listings: Object,
    filters: Object,
});
</script>

<template>
    <h1 class="text-3xl mb-4">Your Listings</h1>
    <section>
        <SellerFilters :filters="filters" />
    </section>
    <section
        v-if="listings.data.length"
        class="grid grid-cols-1 lg:grid-cols-2 gap-2"
    >
        <Box
            v-for="listing in listings.data"
            :key="listing.id"
            :class="{ 'border-dashed': listing.deleted_at }"
        >
            <div
                class="flex flex-col md:flex-row gap-2 md:items-center justify-between"
            >
                <div
                    :class="{
                        'opacity-25 dark:opacity-40': listing.deleted_at,
                    }"
                >
                    <div
                        v-if="listing.sold_at != null"
                        class="text-xs font-bold uppercase border border-dashed p-1 border-green-300 text-green-500 dark:border-green-600 dark:text-green-600 inline-block rounded-md mb-1"
                    >
                        Sold
                    </div>
                    <div class="xl:flex items-center gap-2">
                        <Price
                            :price="listing.price"
                            class="text-2xl font-medium"
                        />
                        <ListingBike :listing="listing" />
                    </div>
                    <ListingContact :listing="listing" class="text-gray-500" />
                    <ListingDetail :listing="listing" />
                </div>

                <section>
                    <div
                        class="flex items-center gap-1 text-gray-600 dark:text-gray-300"
                    >
                        <div v-if="!listing.deleted_at">
                            <a
                                class="btn-outline text-xs font-medium"
                                :href="
                                    route('listing.show', {
                                        listing: listing.id,
                                    })
                                "
                                target="_blank"
                                >Preview</a
                            >
                            <Link
                                class="btn-outline text-xs font-medium"
                                :href="
                                    route('seller.listing.edit', {
                                        listing: listing.id,
                                    })
                                "
                                >Edit</Link
                            >
                            <Link
                                class="btn-delete text-xs font-medium"
                                :href="
                                    route('seller.listing.destroy', {
                                        listing: listing.id,
                                    })
                                "
                                as="button"
                                method="delete"
                            >
                                Delete</Link
                            >
                        </div>

                        <div v-else>
                            <Link
                                class="btn-delete text-xs font-medium"
                                :href="
                                    route('seller.listing.restore', {
                                        listing: listing.id,
                                    })
                                "
                                as="button"
                                method="put"
                            >
                                Restore
                            </Link>
                        </div>
                    </div>
                    <div class="mt-2">
                        <Link
                            :href="
                                route('seller.listing.image.create', {
                                    listing: listing.id,
                                })
                            "
                            class="block w-full btn-outline text-xs font-medium text-center"
                        >
                            Images ({{ listing.images_count }})
                        </Link>
                    </div>
                    <div class="mt-2">
                        <Link
                            :href="
                                route('seller.listing.show', {
                                    listing: listing.id,
                                })
                            "
                            class="block w-full btn-outline text-xs font-medium text-center"
                        >
                            Offers ({{ listing.offers_count }})
                        </Link>
                    </div>
                </section>
            </div>
        </Box>
    </section>

    <EmptyState v-else>No current Listing</EmptyState>

    <section
        v-if="listings.data.length"
        class="w-full flex justify-center mt-4 mb-4"
    >
        <Pagination :links="listings.links" />
    </section>
</template>
