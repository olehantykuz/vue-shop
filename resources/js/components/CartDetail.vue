<template>
    <div>
        <h2>Shopping Cart</h2>
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Product Name</th>
                    <th>Price, {{ currency }}</th>
                    <th>Quantity</th>
                    <th>Total price, {{ currency }}</th>
                    <th>Remove</th>
                </tr>
            </thead>
            <tbody>
                <tr
                    is="cart-detail-item"
                    v-for="(item, index) in items"
                    :key="item.product.id"
                    :product="item.product"
                    :quantity="item.quantity"
                    :rate="conversationRate"
                    :index="index"
                />
            </tbody>
            <tfoot v-if="totalCost > 0">
                <tr>
                    <td colspan="4"></td>
                    <td class="table-info">Total, {{ currency }} </td>
                    <td class="table-info">{{ formattedTotal }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</template>

<script>
    import { mapGetters, mapState } from "vuex";
    import CartDetailItem from "./CartDetailItem";
    import { formatByRateFromCents } from "../helpers";
    import { getProductsByIds } from "../services/product";
    import EventBus from "../event-bus";

    export default {
        name: "CartDetail",
        data() {
            return {
                items: [],
            }
        },
        components: {
            CartDetailItem
        },
        computed: {
            ...mapGetters([
                'conversationRate'
            ]),
            ...mapGetters('cart', ['cart']),
            ...mapState({
                currency: state => state.selectedCurrency,
            }),
            totalCost: function() {
                let cost = 0;
                this.items.forEach(item => {
                    cost += item.quantity * item.product.price;
                });

                return cost;
            },
            formattedTotal: function () {
                return formatByRateFromCents(this.totalCost, this.conversationRate);
            }
        },
        methods: {
            reduceItem (id) {
                const quantity = this.cart[id] || 0;
                let res = [];

                if (quantity) {
                    this.items.forEach(item => {
                        if (+item.product.id === +id) {
                            res.push({ product: item.product, quantity });
                        } else {
                            res.push(item);
                        }
                    });
                } else {
                    res = this.items.filter(item => {
                        return +item.product.id !== +id;
                    })
                }

                this.items = res;
            }
        },
        created() {
            getProductsByIds(Object.keys(this.cart)).then(response => {
                const products = response.data.data;
                products.forEach(product => {
                    this.items.push({ product, quantity: this.cart[product.id] })
                });
            });
        },
        mounted() {
            EventBus.$on('remove-cart-item', (payload) => {
                this.reduceItem(payload.id);
            });
        }
    }
</script>

<style scoped>

</style>
