import { userService } from 'src/services/user';
import router from "src/router";

const token = JSON.parse(window.localStorage.getItem('authToken'));
const state = token
    ? { status: { loggedIn: true }, account: {} , error: null}
    : { status: {}, account: {}, error: null };

const actions = {
    login({ dispatch, commit }, { email, password }) {
        commit('loginRequest', { email });

        userService.login({ email, password })
            .then(
                response => {
                    commit('loginSuccess', response.data.user);
                    dispatch('alert/clear', null, { root: true });
                    router.push({ name: 'home' });
                },
                error => {
                    commit('loginFailure', error);
                    dispatch('alert/error', 'Invalid email or password', { root: true });
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
        commit('registerRequest');
        userService.register({ name, email, password })
            .then(
                response => {
                    commit('registerSuccess', response.data.user);
                    dispatch('alert/clear', null, { root: true });
                },
                error => {
                    commit('registerFailure', 'Invalid email or password');
                    dispatch('alert/error', 'Invalid email or password', { root: true });
                }
            );
    },
    setAccount({ dispatch, commit }) {
        commit('accountRequest');
        userService.getProfile()
            .then(
                response => {
                    commit('accountSuccess', response.data);
                },
                error => {
                    commit('accountFailure', error);
                    if (error.response.status === 401) {
                        window.localStorage.removeItem('authToken');
                    }
                }
            )
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
    },
    accountRequest(state) {
        state.status = { fetchingProfile: true }
    },
    accountSuccess(state, account) {
        state.status = { loggedIn: true };
        state.account = account;
    },
    accountFailure(state) {
        state.status = {};
        state.account = {};
    },
};

const user = {
    namespaced: true,
    state,
    actions,
    mutations
};

export default user;
