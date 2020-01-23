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
    import { mapActions } from "vuex";

    export default {
        name: "App",
        components: {
            Heading,
        },
        created() {
            if (window.localStorage.getItem('authToken')) {
                this.setAccount();
            }
        },
        methods: {
            ...mapActions('user', ['setAccount'])
        }
    }
</script>

<style scoped>

</style>
