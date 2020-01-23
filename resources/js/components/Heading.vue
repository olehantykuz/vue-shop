<template>
    <header>
        <div class="d-flex flex-row justify-content-between">
            <ul class="list-group list-group-horizontal">
                <li class="list-group-item">
                    <router-link :to="{name: 'home'}" exact>Products</router-link>
                </li>
                <li class="list-group-item" v-if="!status.loggedIn">
                    <router-link :to="{name: 'register'}">Register</router-link>
                </li>
                <li class="list-group-item" v-if="!status.loggedIn">
                    <router-link :to="{name: 'login'}">Login</router-link>
                </li>
                <li class="list-group-item" v-if="status.loggedIn">
                    <a href="" @click.prevent="logout">Logout</a>
                </li>
            </ul>
            <div v-if="status.loggedIn">{{ account.email }}</div>
        </div>
    </header>
</template>

<script>
    import { mapState, mapActions } from "vuex";

    export default {
        name: "Heading",
        computed: {
            ...mapState('user', ['status', 'account'])
        },
        methods: {
            ...mapActions('user', ['logout'])
        }
    }
</script>

<style scoped>

</style>
