require('./bootstrap');
window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

import Vuex from 'vuex';
import App from "./App";
import EventBus from "./event-bus";
import { getCurrencies } from "./requests/currency";

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
    }
});

const app = new Vue({
    el: '#app',
    store,
    computed: {
        currencyConversationRate: function () {
            const key = this.$store.state.selectedCurrency;
            const currency = this.currencies[key];

            return currency ? (currency.conversion_rate || 1) : 1;
        }
    },
    created() {
        getCurrencies().then(response => {
            this.$store.commit('setCurrencies', response.data);
        })
    },
    mounted () {
        EventBus.$on('selectCurrency', payload => {
            this.$store.commit('setCurrency', payload);
        });
    },
    render: h => h(App)
});
