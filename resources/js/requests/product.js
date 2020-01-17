import axios from 'axios';

const getProducts = () => {
    return axios({
        url: `/api/products`,
        method: 'get',
    }).then(response => response);
};

export { getProducts };
