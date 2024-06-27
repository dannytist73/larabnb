<script setup>
defineProps({
    listing: Object,
});
</script>

<template>
    <div>
        <span class="font-bold">{{ listing.name }} </span>
        <span class="text-gray-400"> | </span>
        <span class="font-bold">{{ listing.year }} Model</span>
    </div>
</template>
