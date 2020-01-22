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
                    commit('loginSuccess', response.data.user);
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
                    commit('registerSuccess', response.data.user);
                },
                error => {
                    commit('registerFailure', error);
                    // dispatch('alert/error', error, { root: true });
                }
            );
    }
};

const mutations = {
    loginRequest(state) {
        state.status = { loggingIn: true };
    },
    loginSuccess(state, account) {
        state.status = { loggedIn: true };
        state.account = account;
    },
    loginFailure(state) {
        state.status = {};
        state.account = {};
    },
    logout(state) {
        state.status = {};
        state.account = {};
    },
    registerRequest(state) {
        state.status = { registering: true };
    },
    registerSuccess(state, account) {
        state.status = { loggedIn: true };
        state.account = account;
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
