<template>
    <tr>
        <td>{{ product.id }}</td>
        <td>{{ product.category.name }}</td>
        <td>{{ product.name }}</td>
        <td>{{ formattedPrice }}</td>
        <td>
            <input
                class="count-input"
                type="number"
                min="1"
                v-model="quantity"
            />
            <button
                @click="addProduct"
            >
                Add to cart
            </button>
        </td>
    </tr>
</template>

<script>
    import { mapActions } from 'vuex';
    import productItemMixin from "../mixins/prouctItemMixin";

    export default {
        name: "ProductListItem",
        mixins: [ productItemMixin ],
        data () {
            return {
                quantity: 1,
            }
        },
        methods: {
            ...mapActions('cart', [
                'addToCart'
            ]),
            addProduct() {
                this.addToCart({
                    product: Object.assign({}, this.product),
                    quantity: this.quantity
                })
            }
        }
    }
</script>

<style scoped>
    .count-input {
        max-width: 70px;
    }
</style>
