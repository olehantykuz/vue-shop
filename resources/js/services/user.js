import axios from 'axios';
import authHeader from "../helpers/authHeader";

const baseUrl = '/api/auth';
const authorise = response => {
    if (response.status < 400) {
        window.localStorage.setItem('authToken', JSON.stringify(response.data.access_token));
    }
};

const register = data => {
    return axios({
        url: `${baseUrl}/register`,
        method: 'post',
        data,
    }).then(response => {
        authorise(response);

        return response;
    });
};

const login = data => {
    return axios({
        url: `${baseUrl}/login`,
        method: 'post',
        data,
    }).then(response => {
        authorise(response);

        return response;
    });
};

const logout = () => {
    return axios({
        url: `${baseUrl}/logout`,
        method: 'post',
        headers: authHeader(),
    }).then(response => response).finally(() => {
        window.localStorage.removeItem('authToken');
    });
};

const getProfile = () => {
    return axios({
        url: `${baseUrl}/me`,
        method: 'get',
        headers: authHeader(),
    }).then(response => response);
};

export const userService = {
    login,
    logout,
    register,
    getProfile,
};
