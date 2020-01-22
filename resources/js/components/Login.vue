<template>
    <div>
        <h2>Login</h2>
        <form @submit.prevent="handleSubmit">
            <div class="form-group">
                <label for="email">Username</label>
                <input id="email" type="email" v-model="email" name="email" class="form-control" :class="{ 'is-invalid': submitted && !email }" />
                <div v-show="submitted && !email" class="invalid-feedback">Username is required</div>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" v-model="password" name="password" class="form-control" :class="{ 'is-invalid': submitted && !password }" />
                <div v-show="submitted && !password" class="invalid-feedback">Password is required</div>
            </div>
            <div class="form-group">
                <button class="btn btn-primary" :disabled="status.loggingIn">Login</button>
                <router-link to="/register" class="btn btn-link">Register</router-link>
            </div>
        </form>
    </div>
</template>

<script>
    import { mapState, mapActions } from "vuex";

    export default {
        name: "Login",
        data () {
            return {
                email: '',
                password: '',
                submitted: false
            }
        },
        computed: {
            ...mapState('user', ['status'])
        },
        methods: {
            ...mapActions('user', ['login']),
            handleSubmit (e) {
                this.submitted = true;
                const { email, password } = this;
                if (email && password) {
                    this.login({ email, password })
                }
            }
        }
    }
</script>

<style scoped>

</style>
