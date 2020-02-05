const getCart = () => {
    return JSON.parse(window.localStorage.getItem('cart')) || {};
};

const refreshCart = cart => {
    window.localStorage.setItem('cart', JSON.stringify(cart));
};

export { getCart, refreshCart }
