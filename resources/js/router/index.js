import Vue from 'vue';
import Router from 'vue-router';

import Login from "../components/Login";
import Register from "../components/Register";
import ProductList from "../components/ProductList";
import NotFound from "../components/NotFound";

Vue.use(Router);

const router = new Router({
    mode: 'history',
    routes: [
        { name: 'home', path: '/', component: ProductList },
        { name: 'login', path: '/login', component: Login },
        { name: 'register', path: '/register', component: Register },
        { path: '*', component: NotFound },
    ]
});

export default router;
