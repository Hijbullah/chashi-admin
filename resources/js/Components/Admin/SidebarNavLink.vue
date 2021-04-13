<template>
    <inertia-link 
        :href="href" 
        :class="classes">
   
        <slot name="icon"></slot>
       
        <span class="text-gray-700"><slot></slot></span>
    </inertia-link>
</template>

<script>
    export default {
        props: ['href', 'active'],

        computed: {
            classes() {
                return this.active
                        ? 'w-full flex items-center text-blue-400 h-10 pl-4 bg-gray-200 hover:bg-gray-200 rounded-lg cursor-pointer'
                        : 'w-full flex items-center text-blue-400 h-10 pl-4 hover:bg-gray-200 rounded-lg cursor-pointer'
            }
        }
    }
</script>