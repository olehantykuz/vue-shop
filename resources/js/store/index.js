import Vue from 'vue';
import Vuex from 'vuex';
import user from "./modules/user";
import alert from "./modules/alert";

Vue.use(Vuex);

const store = new Vuex.Store({
    modules: {
        user,
        alert,
    },
    state: {
        currencies: {},
        selectedCurrency: 'USD',
    },
    mutations: {
        setCurrency(state, payload) {
            state.selectedCurrency = payload;
        },
        setCurrencies(state, payload) {
            state.currencies = payload;
        }
    },
    getters: {
        conversationRate: state => {
            const key = state.selectedCurrency;
            const currency = state.currencies[key];

            return currency ? (currency.conversion_rate || 1) : 1;
        }
    }
});

export default store;
