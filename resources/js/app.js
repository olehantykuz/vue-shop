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

import router from "./router";
import store from './store';
import { mapActions } from 'vuex';

const app = new Vue({
    el: '#app',
    store,
    router,
    methods: {
        ...mapActions([
            'setCurrencies'
        ])
    },
    created() {
        this.setCurrencies();
    },
    render: h => h(App)
});
