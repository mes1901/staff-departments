import axios from 'axios';

const axiosInstance = axios.create();

axiosInstance.interceptors.request.use((config) => {
    let token = document.head.querySelector('meta[name="csrf-token"]');

    if (token) {
        config.headers['X-CSRF-TOKEN'] = token.content;
    } else {
        console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
    }

    config.headers['X-Requested-With'] = 'XMLHttpRequest';
    config.headers['Content-type'] = 'application/json';
    config.withCredentials = true;

    return config;
});

axiosInstance.interceptors.response.use(response => response.data);

const get = (url, params = {}, headers = {}) => {
    return axiosInstance.get(url, {
        params: params,
        headers: headers
    });
};

const create = (url, data, headers = {}) => {
    return axiosInstance.post(url, data, {
        headers: headers
    });
};

const update = (url, data, headers = {}) => {
    return axiosInstance.put(url, data, {
        headers: headers
    });
};

const destroy = url => axiosInstance.delete(url);

const requestService = {
    create,
    get,
    update,
    destroy
};

export default requestService;
