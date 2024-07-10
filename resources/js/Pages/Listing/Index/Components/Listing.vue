<script setup>
import ListingDetail from "@/Components/ListingDetail.vue";
import ListingBike from "@/Components/ListingBike.vue";
import Price from "@/Components/Price.vue";
import Box from "@/Components/UI/Box.vue";
import { Link } from "@inertiajs/vue3";
import { usePage } from "@inertiajs/vue3";
import { computed } from "vue";

import { useMonthlyPayment } from "@/Composables/useMonthlyPayment";

const props = defineProps({ listing: Object });
const { monthlyPayment } = useMonthlyPayment(props.listing.price, 2.5, 25);

const page = usePage();
const user = computed(() => page.props.user);
</script>

<template>
    <Box>
        <div>
            <Link :href="route('listing.show', listing.id)">
                <ListingBike :listing="listing" class="text-lg" />
                <Price :price="listing.price" class="text-2xl font-bold" />
                <ListingDetail :listing="listing" />
                <div class="flex mt-2 mb-3 items-center">
                    <div class="text-xs text-gray-500 dark:text-gray-300">
                        <b
                            >Monthly Payments:
                            <Price :price="monthlyPayment" />
                        </b>
                    </div>
                </div>
            </Link>
        </div>
    </Box>
</template>
