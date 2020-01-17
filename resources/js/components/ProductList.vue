<template>
    <div>
        <h3>List of Products</h3>
        <table class="table">
            <tr>
                <th>ID</th>
                <th>Category</th>
                <th>Product name</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
            <tr
                is="product-list-item"
                v-for="product in products"
                :key="product.id"
                :product="product"
            >

            </tr>
        </table>
    </div>
</template>

<script>
    import ProductListItem from "./ProductListItem";
    import { getProducts } from "../requests/product";

    export default {
        name: "ProductList",
        components: {
            ProductListItem
        },
        data: function () {
            return {
                products: []
            }
        },
        created() {
            getProducts().then(response => {
                this.products = response.data.data;
            })
        }
    }
</script>

<style scoped>

</style>
