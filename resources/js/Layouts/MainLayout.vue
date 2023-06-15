<template>

<Link href="/"> Main Page</Link>&nbsp;
<Link href="/hello"> Show Page</Link>
<!--<div>The page time with: {{ timer }}</div>-->

<!-- slot render content, if no content, then render Defult -->
<slot>Default</slot>
</template>

<script setup>
  import {Link} from '@inertiajs/vue3';
  //import { ref } from 'vue';

  //const timer = ref(0)
  //setInterval(() => timer.value ++, setTimeout,1000)
</script>
