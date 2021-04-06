<template>
    <seller-authenticated-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Seller Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        You're logged in as seller!
                    </div>
                </div>
            </div>
        </div>
    </seller-authenticated-layout>
</template>

<script>
    import SellerAuthenticatedLayout from '@/Layouts/Seller/Authenticated'

    export default {
        components: {
            SellerAuthenticatedLayout,
        },
    }
</script>
