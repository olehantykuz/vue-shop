<template>
    <tr>
        <td>{{ index + 1}}</td>
        <td>{{ product.name }}</td>
        <td>{{ formattedPrice }}</td>
        <td>{{ quantity }}</td>
        <td>{{ productTotalPrice }}</td>
        <td>
            <input
                class="count-input"
                type="number"
                min="1"
                :max="quantity"
                v-model="removedQuantity"
            />
            <button
                @click="removeProduct"
            >
                Reduce
            </button>
        </td>
    </tr>
</template>

<script>
    import { mapActions } from 'vuex';

    export default {
        name: "CartDetailItem",
        data () {
            return {
                removedQuantity: 1,
            }
        },
        props: {
            product: {
                type: Object,
                required: true
            },
            rate: {
                type: Number,
                required: true,
            },
            quantity: {
                type: Number,
                required: true,
            },
            index: {
                type: Number,
                required: true,
            }
        },
        computed: {
            formattedPrice: function () {
                return parseFloat(this.product.price * this.rate / 100)
                    .toFixed(2);
            },
            productTotalPrice: function () {
                return this.formattedPrice * this.quantity;
            }
        },
        methods: {
            ...mapActions('cart', ['removeFromCart']),
            removeProduct() {
                this.removeFromCart({
                    id: this.product.id,
                    quantity: this.removedQuantity
                })
            }
        }
    }
</script>

<style scoped>

</style>
