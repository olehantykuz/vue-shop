import Vue from 'vue';
import Router from 'vue-router';

import Login from "../components/Login";
import Register from "../components/Register";
import ProductList from "../components/ProductList";

Vue.use(Router);

const router = new Router({
    routes: [
        { path: '/', component: ProductList },
        { path: '/login', component: Login },
        { path: '/register', component: Register },
    ]
});

export default router;
