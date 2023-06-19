<template>
 
 <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
  <Box v-for="listing in listings" :key="listing.id">
    <div>
      <Link :href="route('listing.show',{listing: listing.id})">
       <ListingAddress :listing="listing"></ListingAddress>
      </Link>
    </div>
    <div>
      <Link :href="route('listing.edit',{listing: listing.id})">Edit</Link>
    </div>
    <div>
      <!-- Default method in Inertia Link is Get, But we can use another like Delete Methos-->
      <Link :href="route('listing.destroy',{listing: listing.id})" method="DELETE" as="button">Delete</Link>
    </div>
  </Box>
 </div>

</template>

<script setup>

import ListingAddress from '@/Components/ListingAddress.vue';
import Box from '@/Components/UI/Box.vue';
import { Link } from '@inertiajs/vue3';

defineProps({
    listings: Array,
})
</script>