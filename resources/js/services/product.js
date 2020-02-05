import axios from 'axios';

const getProducts = (url) => {
    return axios({
        url: url || `/api/products`,
        method: 'get',
    }).then(response => response);
};

const getProductsByIds = ids => {
    const key = 'ids';
    const url = `/api/products/cart` + '?' + key + '[]=' + ids.join('&' + key + '[]=');

    return axios({
        url,
        method: 'get',
    }).then(response => response);
};

export { getProducts, getProductsByIds };
