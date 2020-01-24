<template>
    <div class="d-flex flex-row list-group-item rounded">
        <router-link :to="{name: 'cart'}" exact>
        </router-link>
        <div>
            Cart:
            <router-link :to="{name: 'cart'}" exact>
                {{totalCartItems}} products in cart
            </router-link>
        </div>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex';

    export default {
        name: "CartSmall",
        computed: {
            ...mapGetters('cart', ['totalCartItems']),
        }
    }
</script>

<style scoped>

</style>
