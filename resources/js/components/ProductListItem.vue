<template>
    <tr>
        <td>{{ product.id }}</td>
        <td>{{ product.category.name }}</td>
        <td>{{ product.name }}</td>
        <td>{{ product.price }}</td>
    </tr>
</template>

<script>
    export default {
        name: "ProductListItem",
        props: {
            product: {
                type: Object,
                required: true
            },
        }
    }
</script>

<style scoped>

</style>
