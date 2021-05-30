<template>
    <div class="relative">
        <div v-if="!image" @click="photo.click()" class="w-full h-52 border-2 border-gray-300 cursor-pointer hover:bg-white">
            <div class="w-full h-full flex flex-col justify-center items-center space-y-1">
                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>

                <p class="text-xs text-gray-500">
                    Upload
                </p>
            </div>
        </div>    
        <div v-else class="relative w-full h-52 border-2 border-gray-300">
            <button @click.prevent="deleteImage(route('admin.products.images.destroy', image.id))" class="absolute top-2 right-2 bg-red-500 text-white rounded hover:bg-red-700 focus:outline-none">
                <XIcon class="w-5 h-5 fill-current" />
            </button>
            <img :src="image.url" class="w-full h-full" alt="product Image">
        </div>
        <input ref="photo" @change="handleImage" type="file" class="sr-only" />
        <Loading :isLoading="isLoading" />
    </div>
</template>

<script>
    import { ref } from 'vue'
    import { Inertia } from '@inertiajs/inertia'
    import { useForm } from '@inertiajs/inertia-vue3'
    import { XIcon } from '@heroicons/vue/solid'
    import Loading from '@/Components/Loading'

    export default {
        components: { XIcon, Loading },

        props: {
            product: Object,
            image: Object
        },
        
        setup(props) {
            const photo = ref(null)

            let isLoading = ref(false)

            const form = useForm({
                photo: null
            })

            let photoPreview = ref(null)


            const handleImage = () => {
                form.photo = photo.value.files[0];

                form.post(route('admin.products.images.store', props.product.slug), {
                    preserveScroll: true,
                    onBefore: () => isLoading.value = true,
                    onFinish: () => isLoading.value = false,
                    onSuccess: () => form.reset()
                })



                // const reader = new FileReader();
                // reader.onload = (e) => {
                //     photoPreview.value = e.target.result;
                // };
                // reader.readAsDataURL(photo.value.files[0]);
            }

            const deleteImage = url => {
                Inertia.delete(url, {
                    preserveScroll: true,
                    onBefore: () => isLoading.value = true,
                    onFinish: () => isLoading.value = false,
                });
            }

            return { 
                isLoading,
                form, 
                photo, 
                photoPreview, 
                handleImage, 
                deleteImage 
            }

        }
    }
</script>