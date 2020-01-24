<template>
    <a
        class="dropdown-item"
        href=""
        @click.prevent="selectCurrency"
    >
        {{ currency.name }}
    </a>
</template>

<script>
    import { mapMutations } from "vuex";

    export default {
        name: "CurrencyItem",
        props: {
            currency: {
                type: Object,
                required: true
            },
        },
        methods: {
            ...mapMutations([
                'setCurrency'
            ]),
            selectCurrency () {
                this.setCurrency(this.currency.name);
            }
        }
    }
</script>

<style scoped>

</style>
