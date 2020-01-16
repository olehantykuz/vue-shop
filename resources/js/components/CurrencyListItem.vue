<template>
    <li class="list-group-item">
        <a href ="#">{{ currency.name }}</a>
    </li>
</template>

<script>
    export default {
        name: "CurrencyItem",
        props: {
            currency: {
                type: Object,
                required: true
            },
        }
    }
</script>

<style scoped>

</style>
