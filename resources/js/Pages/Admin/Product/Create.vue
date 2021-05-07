<template>
    <admin-authenticated-layout> 
    <div>
        <h2 class="text-xl text-gray-900 font-semibold border-gray-900 uppercase tracking-wider">Add New Product</h2>
        <div class="mt-5">
            <form @submit.prevent="submit">
                <div>
                    <app-label for="category" value="Category" />
                    <app-select 
                        id="category" 
                        class="mt-2 block w-full"
                        v-model="form.category"
                    >
                        <option :value="null">Select a Product Category</option>
                        <CategorySelectChild v-for="category in categories" :key="category.id"  :category="category" />
                    </app-select>
                    <app-input-error :message="form.errors.category" class="mt-2" />
                </div>

                <div class="mt-4">
                    <app-label for="name" value="Product Name" />
                    <app-input ref="name" id="name" type="text" class="mt-2 block w-full" v-model="form.name" placeholder="Name..." autocomplete="name" />
                    <app-input-error :message="form.errors.name" class="mt-2" />
                </div>

                <div class="flex space-x-3 mt-4">
                    <div class="w-1/4">
                        <app-label for="unit" value="Unit" />
                        <app-input id="unit" type="text" class="mt-2 block w-full" v-model="form.unit" placeholder="Unit: kg, gm, ps..." />
                        <app-input-error :message="form.errors.unit" class="mt-2" />
                    </div>

                    <div class="w-1/4">
                        <app-label for="standard_price" value="Standard Price" />
                        <app-input id="standard_price" type="number" class="mt-2 block w-full" v-model="form.standard_price" placeholder="Standard Price..." />
                        <app-input-error :message="form.errors.standard_price" class="mt-2" />
                    </div>

                    <div class="w-1/4">
                        <app-label for="offer_price" value="Offer Price" />
                        <app-input id="offer_price" type="number" class="mt-2 block w-full" v-model="form.offer_price" placeholder="Offer Price..." />
                        <app-input-error :message="form.errors.offer_price" class="mt-2" />
                    </div>

                    <div class="w-1/4">
                        <app-label for="quantity" value="Quantity" />
                        <app-input id="quantity" type="number" class="mt-2 block w-full" v-model="form.quantity" placeholder="Qty..." />
                        <app-input-error :message="form.errors.quantity" class="mt-2" />
                    </div>
                </div>

                <div class="mt-4">
                    <app-label value="Bullet Points"/>
                    <div class="mt-2">
                        <app-input v-model="form.bullet_point_1" type="text" class="block w-full" placeholder="100% Fresh" />
                        <app-input-error :message="form.errors.bullet_point_1" class="mt-2" />
                    </div>
                    <div class="mt-2">
                        <app-input v-model="form.bullet_point_2" type="text" class="block w-full" placeholder="100% Fresh" />
                        <app-input-error :message="form.errors.bullet_point_2" class="mt-2" />
                    </div>
                    <div class="mt-2">
                        <app-input v-model="form.bullet_point_3" type="text" class="block w-full" placeholder="100% Fresh" />
                        <app-input-error :message="form.errors.bullet_point_3" class="mt-2" />
                    </div>
                    <div class="mt-2">
                        <app-input v-model="form.bullet_point_4" type="text" class="block w-full" placeholder="100% Fresh" />
                        <app-input-error :message="form.errors.bullet_point_4" class="mt-2" />
                    </div>
                    <div class="mt-2">
                        <app-input v-model="form.bullet_point_5" type="text" class="block w-full" placeholder="100% Fresh" />
                        <app-input-error :message="form.errors.bullet_point_5" class="mt-2" />
                    </div>
                </div>

                <div class="mt-4">
                    <app-label for="details" value="Product Details" />
                    <textarea id="details" 
                        v-model="form.description" 
                        rows="5" class="mt-2 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                        placeholder="Details...."
                        ></textarea>
                    <app-input-error :message="form.errors.description" class="mt-2" />
                </div>
            

                <div class="mt-5">
                    <app-primary-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Save
                    </app-primary-button>

                    <app-secondary-link 
                        :href="route('admin.products.index')" 
                        class="ml-3"
                    >
                        Back
                    </app-secondary-link>
                </div>
            </form>
        </div>
    </div>
    </admin-authenticated-layout>
</template>

<script>
    import AdminAuthenticatedLayout from '@/Layouts/Admin/Authenticated'  
    import CategorySelectChild from '@/Pages/Admin/Category/CategorySelectChild'  
    import AppLabel from '@/Components/FormElements/Label'
    import AppInput from '@/Components/FormElements/Input'
    import AppSelect from '@/Components/FormElements/Select'
    import AppInputError from '@/Components/FormElements/InputError'
    import AppPrimaryButton from '@/Components/Button/Button'
    import AppSecondaryLink from '@/Components/Link/SecondaryLink'

    import { useForm } from '@inertiajs/inertia-vue3'
    import { XIcon } from '@heroicons/vue/solid'

    export default {
        components: {
            AdminAuthenticatedLayout,
            CategorySelectChild,
            AppInput,
            AppSelect,
            AppInputError,
            AppLabel,
            AppPrimaryButton,
            AppSecondaryLink,
            XIcon
        },

        props: {
            categories: Array
        },
    
        setup() {
            const form = useForm({
                category: null,
                name: '',
                unit: '',
                standard_price: null,
                offer_price: null,
                quantity: null,
                bullet_point_1: '',
                bullet_point_2: '',
                bullet_point_3: '',
                bullet_point_4: '',
                bullet_point_5: '',
                description: '',
            })

            function submit() {
                form.post(route('admin.products.store'), {
                    preserveScroll: true
                })
            }

            return { form, submit }
        }
    }
</script>