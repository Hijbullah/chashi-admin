<template>
    <admin-authenticated-layout> 
        <div>
            <h2 class="text-xl text-gray-900 font-semibold border-gray-900 uppercase tracking-wider">Add New Supplier</h2>
            <div class="mt-5">
                <form @submit.prevent="submit">
                    <div>
                        <app-label for="name" value="Category Name" />
                        <app-input ref="category_name" id="name" type="text" class="mt-2 block w-full" v-model="form.name" placeholder="Category Name..." autofocus autocomplete="name" />
                        <app-input-error :message="form.errors.name" class="mt-2" />
                    </div>
                

                    <div class="mt-5">
                        <app-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Save
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
    import AppSecondaryButton from '@/Components/SecondaryButton'
    import AppSecondaryLink from '@/Components/Link/SecondaryLink'

    import { useForm } from '@inertiajs/inertia-vue3'

    export default {
        components: {
            AdminAuthenticatedLayout,
            AppInput,
            AppInputError,
            AppLabel,
            AppButton,
            AppSecondaryButton,
            AppSecondaryLink
        },

        setup() {
            const form = useForm({
                name: null,
                password: null,
                remember: false,
            })

            function submit() {
                form.post(route('admin.suppliers.store'), {
                    preserveScroll: true,
                    onFinish: () => {
                        form.reset()
                    }
                })
            }

            return { form, submit }
        }
    }
</script>