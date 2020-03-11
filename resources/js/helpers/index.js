import { config } from 'src/config';

const authHeader = () => {
    const token = JSON.parse(window.localStorage.getItem('authToken'));

    return token ? { Authorization: 'Bearer ' + JSON.parse(window.localStorage.getItem('authToken')) } : {};
};

const formatByRateFromCents = (cost, rate) => {
    return parseFloat(cost * rate / 100)
        .toFixed(2);
};

const getApiUrl = (defaultEndpoint, apiEndpoint = null) => {
    return new URL(apiEndpoint || defaultEndpoint, config.backendUrl);
};

export { authHeader, formatByRateFromCents, getApiUrl };
