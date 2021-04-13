<template>
    <option :value="category.id">
        <span v-for="i in category.depth" :key="i">-</span>
        {{ category.name }}
    </option>
    <template v-if="category.children.length > 0">
        <CategorySelectChild v-for="category in category.children" 
            :key="category.id" 
            :category="category" />
    </template>    
</template>

<script>
    
    export default {
        name: 'CategorySelectChild',
        props: ['category']
    }
</script>