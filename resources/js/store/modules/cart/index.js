const state = {
    items: [],
};

const getters = {
    totalCartItems: state => {
        console.log(state.items.length);

        return state.items.length;
    }
};

const actions = {
    addToCart({ commit, state }, { product, quantity }) {
        const id = product.id;
        const cartItem = state.items.find(item => item.product && item.product.id === id);

        if (!cartItem) {
            commit('pushProductToCart', { product, quantity })
        } else {
            commit('incrementItemQuantity', {id: product.id, quantity})
        }
    },
    // removeFromCart({ commit, state }, { id, count }) {
    //     const { cart } = state;
    //     if (id in cart.items) {
    //         if (count >= cart.items[id].count) {
    //             delete  cart.items[id];
    //         } else {
    //             cart.items[id].count -= count;
    //         }
    //     }
    //     commit('setCart', cart);
    // },
    clearCart({ commit }) {
        commit('clearCart')
    }
};

const mutations = {
    pushProductToCart (state, { product, quantity }) {
        state.items.push({
            product,
            quantity
        })
    },

    incrementItemQuantity (state, { id, quantity }) {
        const cartItem = state.items.find(item => item.product && item.product.id === id);
        cartItem.quantity += quantity;
    },

    setCartItems (state, { items }) {
        state.items = items
    },

    setCart(state, payload) {
        state.cart = payload;
    },
    clearCart(state) {
        state.items = [];
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
