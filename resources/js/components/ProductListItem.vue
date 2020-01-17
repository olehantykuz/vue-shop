<template>
    <tr>
        <td>{{ product.id }}</td>
        <td>{{ product.category.name }}</td>
        <td>{{ product.name }}</td>
        <td>{{ formattedPrice }}</td>
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
            rate: {
                type: Number,
                required: true,
            }
        },
        computed: {
            formattedPrice: function () {
                return parseFloat(this.product.price * this.rate / 100)
                    .toFixed(2);
            }
        }
    }
</script>

<style scoped>

</style>
