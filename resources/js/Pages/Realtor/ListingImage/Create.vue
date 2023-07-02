<template>
    <Box>
        <template #header>Upload New Images</template>
        
        <form @submit.prevent="upload">
                <section class="flex items-center gap-2 my-4">
                    <input type="file" multiple @input="addFiles" class="input-file"/>
                    <button type="submit" class="btn-outline disabled:opacity-25 disabled:cursor-not-allowed" :disabled="!canUpload">Upload</button>
                    <button type="reset" class="btn-outline" @click="reset">Reset</button>
                </section>
        </form>
    </Box>
</template>

<script setup>
import Box from '@/Components/UI/Box.vue'
import { useForm } from '@inertiajs/vue3'; 
import { computed } from 'vue';
import NProgress from 'nprogress'
import { router } from '@inertiajs/vue3'

const props = defineProps({ listing: Object })

let timeout = null

router.on('start', () => {
  timeout = setTimeout(() => NProgress.start(), 250)
})

router.on('progress', (event) => {
  if (NProgress.isStarted() && event.detail.progress.percentage) {
    NProgress.set((event.detail.progress.percentage / 100) * 0.9)
  }
})

router.on('finish', (event) => {
  clearTimeout(timeout)
  if (!NProgress.isStarted()) {
    return
  } else if (event.detail.visit.completed) {
    NProgress.done()
  } else if (event.detail.visit.interrupted) {
    NProgress.set(0)
  } else if (event.detail.visit.cancelled) {
    NProgress.done()
    NProgress.remove()
  }
})

// when we use useForm we dont need to write the name images in file field like name="images[]"
const form = useForm({
    images: [],
})

const canUpload = computed(() => form.images.length)

const upload = () => {
    form.post(
        route('realtor.listing.image.store', { listing: props.listing.id}),{
            onSuccess: () => form.reset('images'),
        }
    )
}

const addFiles = (event) => {
    //get the uploaded files
 for(const image of event.target.files){

    //assign image to images: []
    form.images.push(image)
 }
}

const reset = () => form.reset('images')
</script>