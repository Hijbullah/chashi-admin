<template>
    <admin-authenticated-layout>  
        <div>
            <h2 class="text-xl text-gray-900 font-semibold border-b-2 border-gray-900">Products</h2>

            <div class="mt-5">
                <div class="mb-6 flex justify-end items-center">
                    <app-primary-link :href="route('admin.products.create.vital-info')">
                        Create
                    </app-primary-link>
                </div>

                <div class="bg-white rounded shadow overflow-x-auto">
                    <table class="w-full whitespace-no-wrap">
                        <tr class="text-left">
                            <th class="px-6 pt-4 pb-4 font-normal">Name</th>
                            <th class="px-6 pt-4 pb-4 font-normal text-center">Status</th>
                            <th class="px-6 pt-4 pb-4 font-normal text-center">Action</th>
                        </tr>

                        <tr v-for="product in products" :key="product.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                            <td class="border-t px-6 py-2">
                                {{ product.name }}
                            </td>
                            <td class="border-t px-6 py-2 text-center">
                                {{ product.status ? 'Published' : 'Draft' }}
                            </td>
                            
                            <td class="border-t px-6 py-2 text-center space-x-2">
                                <inertia-link 
                                    :href="route('admin.products.edit.vital-info', product.slug)" 
                                    class="inline-flex text-gray-800 hover:text-gray-500 focus:outline-none"
                                >
                                    <svg class="h-5 w-5 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </inertia-link>

                                <button 
                                    class="inline-flex text-red-500 hover:text-red-700 focus:outline-none"
                                    @click.prevent="deleteModel(route('admin.products.destroy', product.slug))"
                                >

                                    <svg class="h-5 w-5 stroke-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />        
                                    </svg>

                                </button>
                            </td>
                        </tr>

                        <tr v-if="products.length === 0">
                            <td class="border-t px-6 py-4" colspan="4">No products found.</td>
                        </tr>
                    
                    </table>
                </div>
            </div>
        </div>
    </admin-authenticated-layout>
</template>

<script>
    import AdminAuthenticatedLayout from '@/Layouts/Admin/Authenticated'   
    import AppPrimaryLink from '@/Components/Link/PrimaryLink'
    import { Inertia } from '@inertiajs/inertia'

    export default {
        components: {
            AdminAuthenticatedLayout,
            AppPrimaryLink
        },

        props: {
            products: Array
        },

        setup() {
            function deleteModel(url) {
               Inertia.delete(url, {
                    only: ['products'],
                    onBefore: () => confirm('Are you sure you want to delete?'),
                });
            }

            return { deleteModel }
        }
    }
</script>