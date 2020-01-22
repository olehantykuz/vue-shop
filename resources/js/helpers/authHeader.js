const authHeader = {
    'Authorization': 'Bearer ' + JSON.parse(window.localStorage.getItem('authToken'))
};

export default authHeader;
