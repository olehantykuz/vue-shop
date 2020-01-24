import Vue from 'vue';
import Router from 'vue-router';

import Login from "../components/Login";
import Register from "../components/Register";
import ProductList from "../components/ProductList";
import CartDetail from "../components/CartDetail";
import NotFound from "../components/NotFound";

Vue.use(Router);

const router = new Router({
    mode: 'history',
    routes: [
        { name: 'home', path: '/', component: ProductList },
        { name: 'login', path: '/login', component: Login },
        { name: 'register', path: '/register', component: Register },
        { name: 'cart', path: '/cart', component: CartDetail },
        { path: '*', component: NotFound },
    ]
});

export default router;
