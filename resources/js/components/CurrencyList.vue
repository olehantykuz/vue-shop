<template>
    <div class="btn-group">
        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ selectedCurrency }}
        </button>
        <div class="dropdown-menu">
            <currency-list-item
                v-for="currency in currencies"
                :currency="currency"
                :key="currency.name"
            />
        </div>
    </div>
</template>

<script>
    import { mapState } from 'vuex';
    import CurrencyListItem from "./CurrencyListItem";

    export default {
        name: "CurrencyList",
        components: {
            CurrencyListItem
        },
        computed: mapState([
            'currencies', 'selectedCurrency'
        ]),
    }
</script>

<style scoped>

</style>
