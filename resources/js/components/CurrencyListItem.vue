<template>
    <li class="list-group-item" :class="{active: isSelected}">
        <a
            href ="#"
            @click="selectCurrency"
            :class="{'currency-selected': isSelected}"
        >
            {{ currency.name }}
        </a>
    </li>
</template>

<script>
    import EventBus from "../event-bus";
    import { mapState } from "vuex";

    export default {
        name: "CurrencyItem",
        props: {
            currency: {
                type: Object,
                required: true
            },
        },
        computed: mapState({
            selectedCurrency: state => state.selectedCurrency,
            isSelected: function () {
                return this.currency.name === this.selectedCurrency;
            },
        }),
        methods: {
            selectCurrency () {
                EventBus.$emit('selectCurrency', this.currency.name);
            }
        }
    }
</script>

<style scoped>
    .currency-selected {
        color: white;
    }
</style>
