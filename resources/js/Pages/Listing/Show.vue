<script setup lang="ts">
import ListingBike from "@/Components/ListingBike.vue";
import ListingDetail from "@/Components/ListingDetail.vue";
import Price from "@/Components/Price.vue";
import Box from "@/Components/UI/Box.vue";
import MakeOffer from "@/Pages/Listing/Show/Components/MakeOffer.vue";
import OfferMade from "@/Pages/Listing/Show/Components/OfferMade.vue";
import EmptyState from "@/Components/UI/EmptyState.vue";

import { ref, computed, onMounted, onUnmounted } from "vue";

import { useMonthlyPayment } from "@/Composables/useMonthlyPayment";
import { usePage } from "@inertiajs/vue3";

const imageContainerStyle = computed(() => {
    return {
        paddingBottom: "66.67%", //3:2 ratio
    };
});

const interestRate = ref(2.5);
const duration = ref(5);

const props = defineProps({
    listing: Object,
    offerMade: Object,
});

const offer = ref(props.listing.price);

const { monthlyPayment, totalPaid, totalInterest } = useMonthlyPayment(
    offer,
    interestRate,
    duration
);

const currentImageIndex = ref(0);

const currentImage = computed(
    () => props.listing.images[currentImageIndex.value] || null
);

const hasPrevious = computed(() => currentImageIndex.value > 0);
const hasNext = computed(
    () => currentImageIndex.value < props.listing.images.length - 1
);

const previous = () => {
    if (hasPrevious.value) currentImageIndex.value--;
};

const next = () => {
    if (hasNext.value) currentImageIndex.value++;
};

const isModalOpen = ref(false);

const openModal = () => {
    isModalOpen.value = true;
    document.body.style.overflow = "hidden";
};

const closeModal = () => {
    isModalOpen.value = false;
    document.body.style.overflow = "";
};

const handleKeyDown = (event: KeyboardEvent) => {
    if (event.key === "Escape" && isModalOpen.value) {
        closeModal();
    }
};

onMounted(() => {
    document.addEventListener("keydown", handleKeyDown);
});

onUnmounted(() => {
    document.removeEventListener("keydown", handleKeyDown);
});

const page = usePage();
const flashSuccess = computed(() => page.props.flash.success);

const user = computed(() => page.props.user);
</script>

<template>
    <div class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4">
        <Box
            v-if="listing.images.length"
            class="md:col-span-7 flex flex-col items-center w-full"
        >
            <div class="relative w-full">
                <div
                    class="relative cursor-pointer group w-full"
                    :style="imageContainerStyle"
                    @click="openModal"
                >
                    <img
                        :src="currentImage.src"
                        class="absolute inset-0 w-full h-full object-cover transition-opacity duration-300"
                        :class="{
                            'group-hover:opacity-75': listing.images.length > 0,
                        }"
                    />
                    <div
                        class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                    >
                        <span
                            class="text-white text-xl bg-black bg-opacity-50 px-4 py-2 rounded"
                            >Click to zoom</span
                        >
                    </div>
                </div>
                <button
                    @click.stop="previous"
                    v-if="hasPrevious"
                    class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full"
                >
                    &larr;
                </button>
                <button
                    @click.stop="next"
                    v-if="hasNext"
                    class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full"
                >
                    &rarr;
                </button>
            </div>

            <!-- Image indicators -->
            <div
                v-if="listing.images.length > 1"
                class="flex justify-center mt-4 space-x-2"
            >
                <button
                    v-for="(image, index) in listing.images"
                    :key="image.id"
                    @click="currentImageIndex = index"
                    class="w-3 h-3 rounded-full transition-all duration-300 focus:outline-none"
                    :class="
                        index === currentImageIndex
                            ? 'bg-blue-500'
                            : 'bg-gray-300 hover:bg-gray-400'
                    "
                ></button>
            </div>

            <!-- Thumbnail previews -->
            <div
                v-if="listing.images.length > 1"
                class="flex justify-center mt-4 space-x-2"
            >
                <img
                    v-for="(image, index) in listing.images"
                    :key="image.id"
                    :src="image.src"
                    @click="currentImageIndex = index"
                    class="w-16 h-16 object-cover cursor-pointer transition-all duration-300"
                    :class="
                        index === currentImageIndex
                            ? 'border-2 border-blue-500 scale-110'
                            : 'opacity-70 hover:opacity-100'
                    "
                />
            </div>
        </Box>
        <EmptyState
            class="md:col-span-7 flex flex-col items-center w-full"
            v-else
            >No images</EmptyState
        >
        <div class="md:col-span-5 flex flex-col gap-4">
            <Box>
                <template #header> Basic Info </template>
                <ListingBike :listing="listing" class="text-lg" />
                <Price :price="listing.price" class="text-2xl font-bold" />
                <ListingDetail :listing="listing" />
            </Box>

            <Box>
                <template #header> Monthly Payment </template>
                <div>
                    <label class="label"
                        >Interest rate ({{ interestRate }} %)</label
                    >
                    <input
                        v-model.number="interestRate"
                        type="range"
                        min="0.25"
                        max="30"
                        step="0.1"
                        class="w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"
                    />
                    <label class="label">Duration ({{ duration }} years)</label>
                    <input
                        v-model.number="duration"
                        type="range"
                        min="3"
                        max="25"
                        step="1"
                        class="w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"
                    />

                    <div class="text-gray-600 dark:text-gray-300 mt-2">
                        <div class="text-gray-400">Your monthly payment</div>
                        <Price :price="monthlyPayment" class="text-3xl" />
                    </div>

                    <div class="mt-2 text-gray-500">
                        <div class="flex justify-between">
                            <div>Total paid</div>
                            <div>
                                <Price :price="totalPaid" class="font-medium" />
                            </div>
                        </div>
                        <div class="flex justify-between">
                            <div>Principal paid</div>
                            <div>
                                <Price
                                    :price="listing.price"
                                    class="font-medium"
                                />
                            </div>
                        </div>
                        <div class="flex justify-between">
                            <div>Interest paid</div>
                            <div>
                                <Price
                                    :price="totalInterest"
                                    class="font-medium"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </Box>

            <MakeOffer
                v-if="user && !offerMade"
                @offer-updated="offer = $event"
                :listing-id="listing.id"
                :price="listing.price"
            />
            <OfferMade v-if="user && offerMade" :offer="offerMade" />
        </div>
    </div>

    <Transition
        enter-active-class="transition ease-out duration-300"
        enter-from-class="opacity-0 scale-95"
        enter-to-class="opacity-100 scale-100"
        leave-active-class="transition ease-in duration-200"
        leave-from-class="opacity-100 scale-100"
        leave-to-class="opacity-0 scale-95"
    >
        <div
            v-if="isModalOpen"
            class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50"
            @click="closeModal"
        >
            <div class="max-w-4xl max-h-full relative" @click.stop>
                <button
                    @click="closeModal"
                    class="absolute -top-10 right-0 text-white bg-black bg-opacity-50 rounded-full p-2 hover:bg-opacity-75 transition-colors duration-200"
                    aria-label="Close"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>
                </button>
                <img
                    :src="currentImage.src"
                    class="max-w-full max-h-full object-contain"
                    @click.stop
                />
            </div>
        </div>
    </Transition>
</template>
