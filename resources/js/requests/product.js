import axios from 'axios';

const getProducts = (url) => {
    return axios({
        url: url || `/api/products`,
        method: 'get',
    }).then(response => response);
};

export { getProducts };
