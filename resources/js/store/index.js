import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

const store = new Vuex.Store({
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
