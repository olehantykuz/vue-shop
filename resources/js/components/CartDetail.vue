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
                    v-for="(item, index) in cartProducts"
                    :key="item.product.id"
                    :product="item.product"
                    :quantity="item.quantity"
                    :rate="conversationRate"
                    :index="index"
                />
            </tbody>
            <tfoot v-if="cartTotalCost > 0">
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

    export default {
        name: "CartDetail",
        components: {
            CartDetailItem
        },
        computed: {
            ...mapGetters([
                'conversationRate'
            ]),
            ...mapGetters('cart', ['cartProducts', 'cartTotalCost']),
            ...mapState({
                currency: state => state.selectedCurrency,
            }),
            formattedTotal: function () {
                return formatByRateFromCents(this.cartTotalCost, this.conversationRate);
            }
        },
    }
</script>

<style scoped>

</style>
