<template>
    <admin-authenticated-layout> 
        <div>
            <h2 class="text-xl text-gray-900 font-semibold border-gray-900 uppercase tracking-wider">Product - Descriptions</h2>
            <div class="mt-5">
                <form @submit.prevent="submit">

                    <div>
                        <app-label for="excerpt">Excerpt <span class="text-xs">(Short Description)</span></app-label>
                        <app-text-area id="excerpt" 
                            class="mt-2 block w-full" 
                            v-model="form.excerpt" 
                            placeholder="Short Description..." 
                            rows="5" 
                            autofocus />
                        <app-input-error :message="form.errors.excerpt" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <app-label for="description" value="Description" />
                        <app-text-area id="description" 
                            class="mt-2 block w-full" 
                            v-model="form.description" 
                            placeholder="Description..." 
                            rows="10" />

                        <app-input-error :message="form.errors.description" class="mt-2" />
                    </div>

                    <div class="mt-5">
                        <app-primary-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Save &amp; Finish
                        </app-primary-button>

                        <app-secondary-link 
                            :href="route('admin.products.edit.images', product.slug)" 
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
    import AppTextArea from '@/Components/FormElements/TextArea'
    import AppInputError from '@/Components/FormElements/InputError'
    import AppPrimaryButton from '@/Components/Button/Button'
    import AppSecondaryLink from '@/Components/Link/SecondaryLink'

    import { useForm } from '@inertiajs/inertia-vue3'

    export default {
        components: {
            AdminAuthenticatedLayout,
            CategorySelectChild,
            AppInput,
            AppTextArea,
            AppInputError,
            AppLabel,
            AppPrimaryButton,
            AppSecondaryLink
        },

        props: {
            product: Object
        },
    
        setup(props) {
  
            const form = useForm({
                excerpt: props.product.excerpt,
                description: props.product.description
            })

            const submit = () => {
                form.put(route('admin.products.update.description', props.product.slug), {
                    preserveScroll: true
                })
            }

            return { form, submit }
        }
    }
</script>