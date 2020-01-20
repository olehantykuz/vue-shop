<template>
    <div>
        <CurrencyList
            :currencies="currencies"
        />
        <ProductList />
    </div>
</template>

<script>
    import { mapState } from "vuex";
    import CurrencyList from "./components/CurrencyList";
    import ProductList from "./components/ProductList";

    export default {
        name: "App",
        components: {
            CurrencyList,
            ProductList,
        },
        computed: mapState([
            'currencies',
        ]),
    }
</script>

<style scoped>

</style>
