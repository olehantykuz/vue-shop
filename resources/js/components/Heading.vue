<template>
    <header>
        <div class="d-flex flex-row justify-content-between">
            <ul class="list-group list-group-horizontal">
                <li class="list-group-item">
                    <router-link to="/" exact>Products</router-link>
                </li>
                <li class="list-group-item">
                    <router-link to="/register">Register</router-link>
                </li>
                <li class="list-group-item">
                    <router-link to="/login">Login</router-link>
                </li>
                <li class="list-group-item"><a href="#">Logout</a></li>
            </ul>
        </div>
    </header>
</template>

<script>
    export default {
        name: "Heading"
    }
</script>

<style scoped>

</style>
