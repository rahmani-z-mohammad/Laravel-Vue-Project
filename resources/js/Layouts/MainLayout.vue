<template>

<Link href="/listing"> Listing</Link>&nbsp;
<Link href="/listing/create"> New Listing</Link>
<!--<div>The page time with: {{ timer }}</div>-->

  <div v-if="flashSuccess" class="success">
  {{ flashSuccess }}
  </div>

<!-- slot render content, if no content, then render Defult -->
<slot>Default</slot>
</template>

<script setup>
//with usePage function we can have access to all data that we share through the Inertia Laravel Middleware
  import {Link, usePage} from '@inertiajs/vue3';
  import { computed } from '@vue/reactivity';
  //import { ref } from 'vue';


  // page.props.flash.success
  const page = usePage()
  const flashSuccess = computed(
    () => page.props.flash.success
  )
  

  //const timer = ref(0)
  //setInterval(() => timer.value ++, setTimeout,1000)
</script>

<style scoped>

.success{

  background-color: green;
  color: white;
}

</style>
