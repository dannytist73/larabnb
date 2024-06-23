<script setup>
import { computed } from "vue";
const props = defineProps({
    price: [Number, String],
});

const formattedPrice = computed(() =>
    Number(props.price).toLocaleString("en-PH", {
        style: "currency",
        currency: "PHP",
        maximumFractionDigits: 0,
    })
);
</script>

<template>
    <span>{{ formattedPrice }}</span>
</template>
