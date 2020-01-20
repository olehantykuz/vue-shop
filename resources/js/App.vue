<template>
    <div>
        <CurrencyList
            :currencies="currencies"
        />
        <ProductList />
    </div>
</template>

<script>
    import CurrencyList from "./components/CurrencyList";
    import ProductList from "./components/ProductList";

    export default {
        name: "App",
        components: {
            CurrencyList,
            ProductList,
        },
        computed: {
            currencies: function () {
                return Object.assign({}, this.$store.state.currencies);
            }
        },
    }
</script>

<style scoped>

</style>
