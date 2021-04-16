<template>
    <inertia-link 
        :href="href" 
        class="btn-secondary"
    >
       <slot></slot>
    </inertia-link>
</template>

<script>
    export default {
        props: {
            href: String
        }
    }
</script>