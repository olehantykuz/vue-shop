<template>
    <div class="row">
        <div class="col-2 offset-10">
            <ul id="currency_menu" class="list-group">
                <li
                    is="currency-list-item"
                    v-for="currency in currencies"
                    :currency="currency"
                >
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    import CurrencyListItem from "./CurrencyListItem";
    export default {
        name: "CurrencyList",
        components: {
            CurrencyListItem
        },
        data: function () {
            return {
                currencies: [
                    {name: 'USD'},
                    {name: 'EUR'},
                    {name: 'UAH'},
                ]
            }
        }
    }
</script>

<style scoped>

</style>
