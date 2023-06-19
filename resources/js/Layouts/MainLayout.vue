<template>

<header class="border-b border-gray-200 dark:border-gray-700 dark:bg-gray-800 bg-white w-full">
  <div class="container mx-auto">
    <nav class="p-4 flex items-center justify-between">
      <div class="text-lg">
        <Link :href="route('listing.index')"> Listing</Link>
      </div>
      <div class="text-lg">
        <Link :href="route('listing.create')" class="bg-blue-900 hover:bg-blue-600 text-white font-medium p-2 rounded-md"> +New Listing</Link>
      </div>
    </nav>
  </div>
</header>

<main class="container mx-auto p-4">

  <div v-if="flashSuccess" class="mb-4 border rounded-md shadow-sm border-green-600 dark:border-green-900 bg-green-50 dark:bg-green-900 p-2">
  {{ flashSuccess }}
  </div>
  
  <!-- slot render content, if no content, then render Defult -->
  <slot>Default</slot>
  
</main>
</template>

<script setup>
//with usePage function we can have access to all data that we share through the Inertia Laravel Middleware
  import {Link, usePage} from '@inertiajs/vue3';
  import { computed } from '@vue/reactivity';


  // page.props.flash.success
  const page = usePage()
  const flashSuccess = computed(
    () => page.props.flash.success
  )
  

</script>