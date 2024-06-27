<script setup lang="ts">
import { computed } from "vue";
const props = defineProps({
    listing: Object,
});

const formattedMileage = computed(() => {
    return new Intl.NumberFormat("en-US").format(props.listing.mileage);
});
</script>

<template>
    <div class="text-gray-400">
        <div>Driven {{ formattedMileage }} kilometers</div>
        <div>Engine Size: {{ props.listing.engine_size }}</div>
        <div>Exterior Color: {{ props.listing.color }}</div>
    </div>
</template>
