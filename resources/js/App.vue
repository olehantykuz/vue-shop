<template>
    <div>
        <CurrencyList />
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
    }
</script>

<style scoped>

</style>
