import { getCart, refreshCart } from '../../../services/cart';

const state = {
    cart: getCart(),
};

const getters = {
    totalCartItems: state => Object.keys(state.cart).length,
    cart: state => state.cart,
};

const actions = {
    addToCart({ commit, state }, { product, quantity }) {
        const id = product.id;
        const formattedQuantity = parseInt(quantity);
        const { cart } = state;

        if (cart[id] === undefined) {
            commit('pushToCart', { id, quantity: formattedQuantity });
        } else {
            commit('incrementBy', {id: product.id, quantity: formattedQuantity});
        }
        refreshCart(state.cart);
    },
    removeFromCart({ commit, state }, { id, quantity }) {
        const { cart } = state;
        if (cart[id] !== undefined) {
            if (quantity >= cart[id]) {
                commit('deleteFromCart', id);
            } else {
                commit('decrementBy', { id, quantity })
            }
        }

        refreshCart(state.cart);
    },
    clear({ commit }) {
        commit('clearCart');
        refreshCart(state.cart);
    }
};

const mutations = {
    pushToCart(state, { id, quantity }) {
        state.cart = { ...state.cart, [id]: quantity }
    },
    deleteFromCart(state, id) {
        const newCart = {};
        Object.keys(state.cart).forEach(key => {
            if (+key !== id) {
                newCart[key] = state.cart[key];
            }
        });
        state.cart = Object.assign({}, newCart);
    },
    incrementBy(state, { id, quantity }) {
        state.cart = { ...state.cart, [id]: quantity + state.cart[id]}
    },
    decrementBy(state, { id, quantity }) {
        state.cart = { ...state.cart, [id]: state.cart[id] - quantity }
    },
    clearCart(state) {
        state.cart = {};
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
