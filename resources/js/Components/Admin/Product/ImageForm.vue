<template>
    <div>
        <div class="h-full w-full border-2 border-gray-300 p-2">
            <div v-if="!image" @click="photo.click()" class="h-full w-full flex flex-col justify-center items-center space-y-1 cursor-pointer hover:bg-white">
                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>

                <p v-if="isMain" class="text-sm font-semibold text-gray-600">Main</p>

                <p class="text-xs text-gray-500">
                    Upload
                </p>
            </div>
            <div class="w-full h-full relative" v-else>
                <img :src="image.url" class="w-full h-full" alt="product Image">
            </div>
        </div>
        <input ref="photo" @change="handleImage" type="file" class="sr-only" />
    </div>
</template>

<script>
    import { ref } from 'vue'
    import { useForm } from '@inertiajs/inertia-vue3'
    import { XIcon, PencilAltIcon } from '@heroicons/vue/solid'

    export default {
        components: { XIcon, PencilAltIcon },

        props: {
            isMain: Boolean,
            product: Object,
            image: Object
        },
        
        setup(props) {
            const photo = ref(null)

            const form = useForm({
                photo: null
            })

            let photoPreview = ref(null)


            const handleImage = () => {
                form.photo = photo.value.files[0];

                form.post(route('admin.products.store.image', props.product.slug), {
                    preserveScroll: true,
                    // onSuccess: () => 
                })



                // const reader = new FileReader();
                // reader.onload = (e) => {
                //     photoPreview.value = e.target.result;
                // };
                // reader.readAsDataURL(photo.value.files[0]);
            }

            return { form, photo, photoPreview, handleImage }

        }
    }
</script>