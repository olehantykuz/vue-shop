<template>
    <div>
        <h2>Shopping Cart</h2>
        <table class="table">
            <tr>
                <th>#</th>
                <th>Product Name</th>
                <th>Price, {{ currency }}</th>
                <th>Quantity</th>
                <th>Total price, {{ currency }}</th>
                <th>Remove</th>
            </tr>
            <tr
                is="cart-detail-item"
                v-for="(item, index) in cartProducts"
                :key="item.product.id"
                :product="item.product"
                :quantity="item.quantity"
                :rate="conversationRate"
                :index="index"
            />
        </table>
    </div>
</template>

<script>
    import { mapGetters, mapState } from "vuex";
    import CartDetailItem from "./CartDetailItem";

    export default {
        name: "CartDetail",
        components: {
            CartDetailItem
        },
        computed: {
            ...mapGetters([
                'conversationRate'
            ]),
            ...mapGetters('cart', ['cartProducts']),
            ...mapState({
                currency: state => state.selectedCurrency,
            }),
        },
    }
</script>

<style scoped>

</style>
