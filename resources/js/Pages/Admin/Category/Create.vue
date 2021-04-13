<template>
    <admin-authenticated-layout>  
        <div class="flex">
            <div class="w-2/3">
                <h2 class="text-xl text-gray-900 font-semibold border-gray-900 uppercase tracking-wider">Category</h2>
                <div class="mt-5">
                    <form @submit.prevent="create">
                        <div>
                            <app-label for="name" value="Category Name" />
                            <app-input ref="category_name" id="name" type="text" class="mt-2 block w-full" v-model="form.name" placeholder="Category Name..." autofocus autocomplete="name" />
                            <app-input-error :message="form.errors.name" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <app-label for="parent" value="Parent" />
                            <app-select id="parent" class="mt-2 block w-full" v-model="form.parent">
                                <option :value="null">Select a Category</option>
                                <CategorySelectChild v-for="category in categories" :key="category.id"  :category="category" />
                                <!-- <option v-for="category in categories" 
                                    :key="category.id" 
                                    :value="category.id"
                                >
                                    {{ category.name }}
                                </option> -->
                            </app-select>
                            <app-input-error :message="form.errors.parent" class="mt-2" />
                        </div>

                        <div class="mt-5">
                            <app-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Save
                            </app-button>
                            <app-secondary-button class="ml-3" @click.prevent="goBack">
                                Back
                            </app-secondary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </admin-authenticated-layout>
</template>

<script>
    import AdminAuthenticatedLayout from '@/Layouts/Admin/Authenticated'    
    import AppInput from '@/Components/Input'
    import AppSelect from '@/Components/Select'
    import CategorySelectChild from './CategorySelectChild'
    import AppInputError from '@/Components/InputError'
    import AppLabel from '@/Components/Label'
    import AppButton from '@/Components/Button'
    import AppSecondaryButton from '@/Components/SecondaryButton'

    export default {
        components: {
            AdminAuthenticatedLayout,
            AppInput,
            AppSelect,
            CategorySelectChild,
            AppInputError,
            AppLabel,
            AppButton,
            AppSecondaryButton
        },

        props: {
            categories: Array
        },
        
        data() {
            return {
                form: this.$inertia.form({
                    name: '',
                    parent: null
                }),
            }
        },
        methods: {
            create(){
                this.form.post(route('admin.categories.store'), {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.form.reset('name');
                        this.$refs.category_name.focus()
                    }
                });
            }, 
            goBack() {
                this.$inertia.visit(route('admin.categories.index'));
            }
        }
    }
</script>