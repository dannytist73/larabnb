<script setup lang="ts">
defineProps({
    listing: Object,
});
</script>

<template>
    <div>
        <b>{{ listing.seller_contact }}</b>
        <br />
        Listed in {{ listing.location }}
    </div>
</template>
