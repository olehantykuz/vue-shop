import axios from 'axios';
import { getApiUrl } from 'src/helpers';

const getProducts = (fetchUrl) => {
    const url = getApiUrl(`/api/products`, fetchUrl);

    return axios({
        url,
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

const searchProducts = (baseUrl, query, count = null) => {
    let url = getApiUrl(`/api/products/search`, baseUrl);

    url.searchParams.append('query', query);
    if (count) {
        url.searchParams.append('count', count);
    }

    return axios({
        url: url.toString(),
        method: 'get',
    }).then(response => response);
};

export { getProducts, getProductsByIds, searchProducts };
