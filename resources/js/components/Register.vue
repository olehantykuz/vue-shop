<template>
    <div>
        <h2>Register</h2>
        <ValidationObserver ref="form">
            <form @submit.prevent="handleSubmit">
                <div class="form-group">
                    <ValidationProvider name="user.name" rules="required|max:255" v-slot="{ errors, invalid }">
                        <label for="register-name">First Name</label>
                        <input
                            id="register-name"
                            type="text"
                            v-model="user.name"
                            name="name"
                            class="form-control"
                            :class="{ 'is-invalid': submitted && invalid }"
                        />
                        <div v-if="submitted && invalid" class="invalid-feedback">{{ errors[0] }}</div>
                    </ValidationProvider>
                </div>
                <div class="form-group">
                    <ValidationProvider name="user.email" rules="required|email" v-slot="{ errors, invalid }">
                        <label for="register-email">Email</label>
                        <input
                            id="register-email"
                            type="email"
                            v-model="user.email"
                            name="email"
                            class="form-control"
                            :class="{ 'is-invalid': submitted && invalid }"
                        />
                        <div v-if="submitted && invalid" class="invalid-feedback">{{ errors[0] }}</div>
                    </ValidationProvider>
                </div>
                <div class="form-group">
                    <ValidationProvider name="user.password" rules="required|min:8|max:255" v-slot="{ errors, invalid }">
                        <label for="register-password">Password</label>
                        <input
                            id="register-password"
                            type="password"
                            v-model="user.password"
                            name="password"
                            class="form-control"
                            :class="{ 'is-invalid': submitted && invalid }"
                        />
                        <div v-if="submitted && invalid" class="invalid-feedback">{{ errors[0] }}</div>
                    </ValidationProvider>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" :disabled="status.registering">Register</button>
                    <router-link to="/login" class="btn btn-link">Login</router-link>
                </div>
            </form>
        </ValidationObserver>
    </div>
</template>

<script>
    import { mapState, mapActions } from 'vuex';
    import { ValidationProvider, ValidationObserver, extend } from 'vee-validate';
    import { required, email, min, max } from 'vee-validate/dist/rules';

    extend('email', email);
    extend('required', required);
    extend('min', min);
    extend('max', max);

    export default {
        name: "Register",
        components: {
            ValidationProvider,
            ValidationObserver
        },
        data () {
            return {
                user: {
                    name: '',
                    email: '',
                    password: ''
                },
                submitted: false
            }
        },
        computed: {
            ...mapState('user', ['status']),
            ...mapState([
                'alert'
            ])
        },
        methods: {
            ...mapActions('user', ['register']),
            ...mapActions('alert', ['clear']),
            handleSubmit(e) {
                this.submitted = true;

                this.$refs.form.validate().then(success => {
                    if (!success) {

                        return;
                    }
                    const { user } = this;
                    this.user.name = this.user.email = this.user.password = '';
                    this.$refs.form.reset();
                    this.register(user);
                });
            }
        },
        updated() {
            if (this.alert.type === 'alert-danger') {
                alert(this.alert.message);
            }
        },
        beforeDestroy() {
            this.clear();
        }
    }
</script>

<style scoped>

</style>
