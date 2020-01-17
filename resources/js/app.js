require('./bootstrap');
window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

import App from "./App";
import EventBus from "./event-bus";
import { getCurrencies } from "./requests/currency";

const app = new Vue({
    el: '#app',
    data: {
        currencies: {},
        selectedCurrency: 'USD',
    },
    computed: {
        currencyConversationRate: function () {
            const key = this.selectedCurrency;
            const currency = this.currencies[key];

            return currency ? (currency.conversion_rate || 1) : 1;
        }
    },
    methods: {
        updateSelectedCurrency(payload) {
            this.selectedCurrency = payload;
        }
    },
    created() {
        getCurrencies().then(response => {
            this.currencies = response.data;
        })
    },
    mounted () {
        EventBus.$on('selectCurrency', payLoad => {
            this.updateSelectedCurrency(payLoad);
        });
    },
    render: h => h(App)
});
