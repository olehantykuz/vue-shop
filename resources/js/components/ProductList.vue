<template>
    <div>
        <h3 class="text-center">List of Products</h3>
        <div class="products-meta d-flex justify-content-between">
            <ul class="pagination">
                <li class="page-item"><a class="page-link" href="" @click.prevent="fetchProducts(pagination.links.prev)">Previous</a></li>
                <li style="display: flex;" class="page-item flex align-items-center pl-1 pr-1"><div>Page {{pagination.meta.current_page}} of {{pagination.meta.last_page}}</div></li>
                <li class="page-item"><a class="page-link" href="" @click.prevent="fetchProducts(pagination.links.next)">Next</a></li>
            </ul>
            <form>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Search"
                            v-model="search"
                        >
                    </div>
                </div>
            </form>
        </div>
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
    import { debounce } from 'lodash';
    import { mapGetters, mapState } from 'vuex';
    import ProductListItem from "./ProductListItem";
    import { getProducts, searchProducts } from "../services/product";

    export default {
        name: "ProductList",
        components: {
            ProductListItem,
        },
        data: function () {
            return {
                products: [],
                search: '',
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
                const query = this.search.trim();
                const promise = query ? searchProducts(url, query) : getProducts(url);

                promise.then(response => {
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
        watch: {
            'search': debounce(function () {
                this.fetchProducts();
            }, 300),
        },
    }
</script>

<style scoped>

</style>
