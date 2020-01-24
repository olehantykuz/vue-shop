const state = {
    items: [],
};

const getters = {
    totalCartItems: state => state.items.length,
    cartProducts: state => state.items,
};

const actions = {
    addToCart({ commit, state }, { product, quantity }) {
        const id = product.id;
        const cartItem = findItemInCart(id);
        const formattedQuantity = parseInt(quantity);

        if (!cartItem) {
            commit('pushItemToCart', { product, quantity: formattedQuantity })
        } else {
            commit('incrementItemQuantity', {id: product.id, quantity: formattedQuantity})
        }
    },
    removeFromCart({ commit, state }, { id, quantity }) {
        const cartItem = findItemInCart(id);

        if (cartItem) {
            if (quantity >= cartItem.quantity) {
                commit('removeItemFromCart', id)
            } else {
                commit('decrementItemQuantity', { id, quantity })
            }
        }
    },
    clearCart({ commit }) {
        commit('clearCart')
    }
};

const mutations = {
    pushItemToCart (state, { product, quantity }) {
        state.items.push({
            product,
            quantity
        })
    },
    removeItemFromCart (state, id) {
        const items = state.items.filter(item => {
            return item.product.id != id;
        });
        state.items = items;
    },
    incrementItemQuantity (state, { id, quantity }) {
        const cartItem = findItemInCart(id);
        cartItem.quantity += quantity;
    },
    decrementItemQuantity (state, { id, quantity }) {
        const cartItem = findItemInCart(id);
        cartItem.quantity -= quantity;
    },
    setCartItems (state, { items }) {
        state.items = items
    },
    clearCart(state) {
        state.items = [];
    }
};

const findItemInCart = id => state.items.find(item => item.product && item.product.id === id);

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
