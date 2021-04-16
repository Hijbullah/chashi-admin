<template>
    <admin-authenticated-layout>  
        <div>
            <h2 class="text-xl text-gray-900 font-semibold border-b-2 border-gray-900">Categories</h2>

            <div class="mt-5">
                <div class="mb-6 flex justify-end items-center">
                    <app-primary-link :href="route('admin.categories.create')">
                        Create
                    </app-primary-link>
                </div>

                <div class="bg-white rounded shadow overflow-x-auto">
                    <table class="w-full whitespace-no-wrap">
                        <tr class="text-left">
                            <th class="px-6 pt-4 pb-4 font-normal">Name</th>
                            <th class="px-6 pt-4 pb-4 font-normal">Slug</th>
                            <th class="px-6 pt-4 pb-4 font-normal text-center">Action</th>
                        </tr>

                        <CategoryTableChild v-for="category in categories" 
                            :key="category.id"
                            :category="category" />

                        <tr v-if="categories.length === 0">
                            <td class="border-t px-6 py-4" colspan="4">No categories found.</td>
                        </tr>
                    
                    </table>
                </div>
            </div>
        </div>
    </admin-authenticated-layout>
</template>

<script>
    import AdminAuthenticatedLayout from '@/Layouts/Admin/Authenticated'   
    import CategoryTableChild from './CategoryTableChild' 
    import AppPrimaryLink from '@/Components/Link/PrimaryLink'

    export default {
        components: {
            AdminAuthenticatedLayout,
            CategoryTableChild,
            AppPrimaryLink
        },

        props: {
            categories: Array
        }
    }
</script>