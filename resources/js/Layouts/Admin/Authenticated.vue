<template>
    <div class="leading-normal tracking-normal">
        <div class="flex flex-wrap">

            <AdminSidebar />

            <div class="w-full bg-gray-100 pl-0 lg:pl-64 min-h-screen">

                <AdminNavbar />

                <main>
                    <div class="p-6 bg-gray-100 mb-20">
                        <Alert />
                        <slot></slot>
                    </div>
                </main>

                <!-- <portal-target name="modal" multiple></portal-target> -->

            </div>
        </div>
    </div>
</template>

<script>
    import AdminNavbar from '@/Components/Admin/Navbar'
    import AdminSidebar from '@/Components/Admin/Sidebar'
    import Alert from '@/Components/Alert'

    export default {
        components: {
            AdminNavbar,
            AdminSidebar, 
            Alert
        }
    }
</script>
