const authHeader = () => {
    const token = JSON.parse(window.localStorage.getItem('authToken'));

    return token ? { Authorization: 'Bearer ' + JSON.parse(window.localStorage.getItem('authToken')) } : {};
};

export default authHeader;
