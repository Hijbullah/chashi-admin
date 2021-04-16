<template>
    <admin-authenticated-layout> 
        <div>
            <h2 class="text-xl text-gray-900 font-semibold border-gray-900 uppercase tracking-wider">Add New Supplier</h2>
            <div class="mt-5">
                <form @submit.prevent="update">
                    <div>
                        <app-label for="name" value="Supplier Name" />
                        <app-input ref="name" id="name" type="text" class="mt-2 block w-full" v-model="form.name" placeholder="Name..." autofocus autocomplete="name" />
                        <app-input-error :message="form.errors.name" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <app-label for="details" value="Supplier Details" />
                        <textarea id="details" 
                            v-model="form.details" 
                            rows="5" class="mt-2 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                            placeholder="Details...."
                            ></textarea>
                        <app-input-error :message="form.errors.details" class="mt-2" />
                    </div>
                

                    <div class="mt-5">
                        <app-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Update
                        </app-button>

                        <app-secondary-link 
                            :href="route('admin.suppliers.index')" 
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
    import AppLabel from '@/Components/Label'
    import AppInput from '@/Components/Input'
    import AppInputError from '@/Components/InputError'
    import AppButton from '@/Components/Button'
    import AppSecondaryLink from '@/Components/Link/SecondaryLink'

    import { useForm } from '@inertiajs/inertia-vue3'

    export default {
        components: {
            AdminAuthenticatedLayout,
            AppInput,
            AppInputError,
            AppLabel,
            AppButton,
            AppSecondaryLink
        },

        props: ['supplier'],

        setup(props) {
            const form = useForm({
                name: props.supplier.name,
                details: props.supplier.details,
            })

            function update() {
                form.put(route('admin.suppliers.update', props.supplier.slug), {
                    preserveScroll: true
                })
            }

            return { form, update }
        }
    }
</script>