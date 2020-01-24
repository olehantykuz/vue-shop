const authHeader = () => {
    const token = JSON.parse(window.localStorage.getItem('authToken'));

    return token ? { Authorization: 'Bearer ' + JSON.parse(window.localStorage.getItem('authToken')) } : {};
};

const formatByRateFromCents = (cost, rate) => {
    return parseFloat(cost * rate / 100)
        .toFixed(2);
};

export { authHeader, formatByRateFromCents };
