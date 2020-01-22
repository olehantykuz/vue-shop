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
import { getCurrencies } from "./requests/currency";

import router from "./router";
import store from './store';

const app = new Vue({
    el: '#app',
    store,
    router,
    created() {
        getCurrencies().then(response => {
            this.$store.commit('setCurrencies', response.data);
        })
    },
    render: h => h(App)
});
