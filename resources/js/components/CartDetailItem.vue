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
    import productItemMixin from "../mixins/prouctItemMixin";
    import EventBus from "../event-bus";

    export default {
        name: "CartDetailItem",
        mixins: [ productItemMixin ],
        data () {
            return {
                removedQuantity: 1,
            }
        },
        props: {
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
            productTotalPrice: function () {
                return (this.formattedPrice * this.quantity).toFixed(2);
            }
        },
        methods: {
            ...mapActions('cart', ['removeFromCart']),
            removeProduct() {
                const data = {
                    id: this.product.id,
                    quantity: this.removedQuantity
                };
                this.removeFromCart(data);
                EventBus.$emit('remove-cart-item', data)
            }
        }
    }
</script>

<style scoped>

</style>
