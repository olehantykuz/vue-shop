import axios from 'axios';

const getCurrencies = () => {
    return axios({
        url: `/api/currencies`,
        method: 'get',
    }).then(response => response);
};

export { getCurrencies };
