<template>
    <div class="d-flex flex-row list-group-item">
        <div>Cart: {{totalCartItems}} items in cart</div>
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
