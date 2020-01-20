<template>
    <div class="row">
        <div class="col-2 offset-10">
            <ul id="currency_menu" class="list-group">
                <li
                    is="currency-list-item"
                    v-for="currency in currencies"
                    :currency="currency"
                    :key="currency.name"
                >
                </li>
            </ul>
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
            'currencies',
        ]),
    }
</script>

<style scoped>

</style>
