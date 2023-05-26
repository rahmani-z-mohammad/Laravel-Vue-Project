<template>

<div>
    Index
</div>
<div>
  The Message is: {{ message }}
</div>

</template>

<script setup>
  import {Link} from '@inertiajs/vue3';
  defineProps(
    {
      message: String
    }
  )

</script>


<!--

  When want to another layout, just not the default, we can set another one
<script>
 import MainLayout from '../../Layouts/MainLayout.vue';

 export default{
    layout: MainLayout
 }
</script>
-->