<template>
    <div class="sticky top-0 z-40">
        <div class="w-full h-16 px-6 bg-gray-100 border-b flex items-center justify-between">
            <div class="flex">
                <div class="inline-block  items-center"> <!-- flex -->
                    <button class="hover:text-blue-500 hover:border-white focus:outline-none navbar-burger">
                        <svg class="h-5 w-5" v-bind:style="{ fill: 'black' }" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
                    </button>
                </div>
            </div>
            
            <div class="flex items-center ml-6">
                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                    <app-dropdown align="right" width="48">
                        <template #trigger>
                            <span class="inline-flex rounded-md">
                                <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    {{ $page.props.auth.user.name }}

                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </span>
                        </template>

                        <template #content>
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                Manage Account
                            </div>

                            <div class="border-t border-gray-100"></div>

                           <!-- Authentication -->
                            <app-dropdown-link :href="route('admin.logout')" method="post" as="button">
                                Log Out
                            </app-dropdown-link>
                        </template>
                    </app-dropdown>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import AppDropdown from '@/Components/Dropdown'
    import AppDropdownLink from '@/Components/DropdownLink'

    export default {
        components: {
            AppDropdown,
            AppDropdownLink,
        },
        data() {
            return {
                showingNavigationDropdown: false,
            }
        }
    }
</script>