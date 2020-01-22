import { userService } from '../../../services/user';
import router from "../../../router";

const token = JSON.parse(window.localStorage.getItem('authToken'));
const state = token
    ? { status: { loggedIn: true }, account: {} }
    : { status: {}, account: {} };

const actions = {
    login({ dispatch, commit }, { email, password }) {
        commit('loginRequest', { email });

        userService.login({ email, password })
            .then(
                response => {
                    commit('loginSuccess', email);
                    router.push({ name: 'home' });
                },
                error => {
                    commit('loginFailure', error);
                    // dispatch('alert/error', error, { root: true });
                }
            );
    },
    logout({ commit }) {
        userService.logout()
            .then(response => {
                commit('logout');
            }).catch(error => {
                console.log('error', error)
            }).finally(() => {
                router.push({ name: 'login' })
            });
    },
    register({ dispatch, commit }, { name, email, password }) {
        commit('registerRequest', email);

        userService.register({ name, email, password })
            .then(
                response => {
                    commit('registerSuccess', email);
                },
                error => {
                    commit('registerFailure', error);
                    // dispatch('alert/error', error, { root: true });
                }
            );
    }
};

const mutations = {
    loginRequest(state, email) {
        state.status = { loggingIn: true };
    },
    loginSuccess(state, email) {
        state.status = { loggedIn: true };
        state.account.email = email;
    },
    loginFailure(state) {
        state.status = {};
        state.account = {};
    },
    logout(state) {
        state.status = {};
        state.account = {};
    },
    registerRequest(state, email) {
        state.status = { registering: true };
    },
    registerSuccess(state, email) {
        state.status = {};
        state.account.email = email;
    },
    registerFailure(state, error) {
        state.status = {};
    }
};

const user = {
    namespaced: true,
    state,
    actions,
    mutations
};

export default user;
