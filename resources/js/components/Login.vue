<template>
    <div>
        <div class="alert alert-danger" v-if="error">
            <p>There was an error, unable to sign in with those credentials.</p>
        </div>
        <form autocomplete="off">
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" class="form-control" v-model="password" required>
            </div>
            <button
                type="button"
                class="btn btn-info"
                @click="loginUser"
            >
                Sign in
            </button>
        </form>
    </div>
</template>

<script>
    import { login } from "../services/user";
    import { mapState } from "vuex";

    export default {
        name: "Login",
        data: function() {
            return {
                error: null,
                sending: false,
            }
        },
        computed: {
            email: {
                get () {
                    return this.$store.state.login.email
                },
                set (value) {
                    this.$store.commit('login/updateEmail', value)
                }
            },
            password: {
                get () {
                    return this.$store.state.login.password
                },
                set (value) {;
                    this.$store.commit('login/updatePassword', value)
                }
            },
            disabledButton() {
                return this.error && this.sending;
            },
            ...mapState({
                form: state => state.login,
            }),
        },
        methods: {
            loginUser() {
                login(this.form).then(response => {

                });
            }
        }
    }
</script>

<style scoped>

</style>
