<template>
  <div>
    <ListingAddress :listing="listing" />
  </div>
</template>

<script setup lang="ts">
import ListingAddress from "@/Components/ListingAddress.vue";

defineProps({
    listing: Object
})
</script>

<style>

</style>