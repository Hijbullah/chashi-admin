<template>
    <admin-authenticated-layout> 
        <div>
            <h2 class="text-xl text-gray-900 font-semibold border-gray-900 uppercase tracking-wider">Product - Images</h2>
            <div class="mt-5">
                <h2>Product Images</h2>
                <div class="mt-4 px-4 py-6 border-2 border-dashed border-gray-300">
                    <h4>product Image guideline</h4>
                </div>
               
                <div class="mt-4">
                    <div class="mt-4 grid grid-cols-5 gap-3">
                        <image-form 
                            v-for="i in 10" 
                            :key="i"
                            :product="product"
                            :image="images[i - 1] ?? null"
                        ></image-form>
                    </div>
                </div>

                <div class="mt-5">
                    <app-primary-button @click.prevent="goToNext">
                        Save &amp; Next
                    </app-primary-button>

                    <app-secondary-link 
                        :href="route('admin.products.edit.vital-info', product.slug)" 
                        class="ml-3"
                    >
                        Back
                    </app-secondary-link>
                </div>
            </div>
        </div>
    </admin-authenticated-layout>
</template>

<script>
    import { Inertia } from '@inertiajs/inertia'
    import AdminAuthenticatedLayout from '@/Layouts/Admin/Authenticated'  
    import ImageForm from '@/Components/Admin/Product/ImageForm'
    import AppInputError from '@/Components/FormElements/InputError'
    import AppPrimaryButton from '@/Components/Button/Button'
    import AppSecondaryLink from '@/Components/Link/SecondaryLink'

    export default {
        components: {
            AdminAuthenticatedLayout,
            ImageForm,
            AppInputError,
            AppPrimaryButton,
            AppSecondaryLink
        },

        props: {
            product: Object,
            images: Array
        },
        setup(props) {
            const goToNext = () => {
                Inertia.get(route('admin.products.edit.description', props.product.slug), '', {
                    onBefore: () => {
                        if(props.images.length < 3) {
                            alert('Atleast 3 images need to be added!');
                            return false;
                        }
                    }
                })
            }

            return { goToNext }
        }
    }
</script>