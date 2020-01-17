<template>
    <div>
        <h3>List of Products</h3>
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="" @click.prevent="fetchProducts(pagination.prev_page_url)">Previous</a></li>
            <li style="display: flex;" class="page-item flex align-items-center"><div>Page {{pagination.current_page}} of {{pagination.last_page}}</div></li>
            <li class="page-item"><a class="page-link" href="" @click.prevent="fetchProducts(pagination.next_page_url)">Next</a></li>
        </ul>
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
                products: [],
                pagination: {},
            }
        },
        created() {
            this.fetchProducts();
        },
        methods: {
            fetchProducts: function(url = null) {
                getProducts(url).then(response => {
                    this.products = response.data.data;
                    this.makePagination(response.data);
                })
            },

            makePagination: function(data) {
                this.pagination = {
                    current_page: data.current_page,
                    last_page: data.last_page,
                    path: data.path,
                    first_page_url: data.first_page_url,
                    last_page_url: data.last_page_url,
                    next_page_url: data.next_page_url,
                    prev_page_url: data.prev_page_url,
                    per_page: data.per_page,
                    from: data.from,
                    to: data.to,
                    total: data.total
                };
            }
        },
    }
</script>

<style scoped>

</style>
