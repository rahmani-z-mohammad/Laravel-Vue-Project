<template>

    <div class="flex flex-col-reverse md:grid grid-cols-12 gap-4">
        <Box class="md:col-span-7 flex items-center w-full">
            <div class="w-full text-center">No Image!</div>
        </Box>
        <div class="md:col-span-5 flex flex-col gap-4">
            <Box>
                <template #header>Basic Info</template>
                <Price :price="listing.price" class="text-2xl font-bold"></Price>
                <ListingSpace :listing="listing" class="text-lg"></ListingSpace>
                <ListingAddress :listing="listing" class="text-gray-500"></ListingAddress>
            </Box>
            <Box>
                <template #header>Ofer</template>
                Make an Offer!   
            </Box>
        </div>
    </div>

</template>

<script setup>
import ListingAddress from '@/Components/ListingAddress.vue';
import ListingSpace from '@/Components/ListingSpace.vue';
import Price from '@/Components/Price.vue';
import Box from '@/Components/UI/Box.vue';

defineProps({
    listing: Object
})
</script>