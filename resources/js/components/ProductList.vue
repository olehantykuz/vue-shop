<template>
    <div>
        <h3>List of Products</h3>
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="" @click.prevent="fetchProducts(pagination.links.prev)">Previous</a></li>
            <li style="display: flex;" class="page-item flex align-items-center"><div>Page {{pagination.meta.current_page}} of {{pagination.meta.last_page}}</div></li>
            <li class="page-item"><a class="page-link" href="" @click.prevent="fetchProducts(pagination.links.next)">Next</a></li>
        </ul>
        <table class="table">
            <tr>
                <th>ID</th>
                <th>Category</th>
                <th>Product name</th>
                <th>Price, {{ currency }}</th>
                <th>Action</th>
            </tr>
            <tr
                is="product-list-item"
                v-for="product in products"
                :key="product.id"
                :product="product"
                :rate="conversationRate"
            >
            </tr>
        </table>
    </div>
</template>

<script>
    import { mapGetters, mapState } from 'vuex';
    import ProductListItem from "./ProductListItem";
    import { getProducts } from "../services/product";

    export default {
        name: "ProductList",
        components: {
            ProductListItem,
        },
        data: function () {
            return {
                products: [],
                pagination: {
                    links: {},
                    meta: {},
                },
            }
        },
        computed: {
            ...mapGetters([
                'conversationRate'
            ]),
            ...mapState({
                currency: state => state.selectedCurrency,
            }),
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
                    links: data.links,
                    meta: data.meta,
                };
            }
        },
    }
</script>

<style scoped>

</style>
