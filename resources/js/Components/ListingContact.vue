<script setup lang="ts">
defineProps({
    listing: Object,
});
</script>

<template>
    <div>
        ✉️&nbsp;<b>{{ listing.seller_contact }}</b>
        <br />
        📍&nbsp;Listed in {{ listing.location }}
    </div>
</template>
