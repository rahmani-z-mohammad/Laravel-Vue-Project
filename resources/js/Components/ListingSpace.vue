<template>
    <div>
      <span class="font-bold">{{ listing.beds }}</span> Bed <span class="text-gray-400"> | </span>
      <span class="font-bold">{{ listing.baths }}</span> Bath <span class="text-gray-400"> | </span>
      <span class="font-bold">{{ listing.area }}</span> Area m²
    </div>
</template>

<script setup>
defineProps({
listing: Object
})
</script>