<template>
    <admin-authenticated-layout> 
        <div>
            <h2 class="text-xl text-gray-900 font-semibold border-gray-900 uppercase tracking-wider">Add New Product - Images</h2>
            <div class="mt-5">
                <h2>Product Images</h2>
                <div class="mt-4 px-4 py-6 flex justify-center items-center bg-white">
                    <h4>product Image guideline</h4>
                </div>
               
                <div class="mt-4">
                    <div class="mt-4 grid grid-cols-5 gap-3">
                        <image-form 
                            class="h-52"
                            v-for="i in 10" 
                            :key="i"
                            :product="product"
                            :image="images[i - 1] ?? null"
                        ></image-form>
                    </div>
                </div>

                <div class="mt-5 text-center">
                    <app-primary-button>
                        Save &amp; Next
                    </app-primary-button>
                </div>
            </div>
        </div>
    </admin-authenticated-layout>
</template>

<script>
    import AdminAuthenticatedLayout from '@/Layouts/Admin/Authenticated'  
    import ImageForm from '@/Components/Admin/Product/ImageForm'
    import AppInputError from '@/Components/FormElements/InputError'
    import AppPrimaryButton from '@/Components/Button/Button'
    

    export default {
        components: {
            AdminAuthenticatedLayout,
            ImageForm,
           
            AppInputError,
            AppPrimaryButton
        },

        props: {
            product: Object,
            images: Array
        }
    }
</script>