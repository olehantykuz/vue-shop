<template>
    <div class="container">
        <Heading />
        <div role="main">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    import Heading from "./components/Heading";

    export default {
        name: "App",
        components: {
            Heading,
        },
    }
</script>

<style scoped>

</style>
