import axios from 'axios';

axios.defaults.baseURL = 'http://example.com/api/v1/';
axios.defaults.timeout = 20000;
axios.defaults.responseType = 'json';
axios.defaults.validateStatus = function (status) {
    return status < 500; // Reject only if the status code is greater than or equal to 500
};

export default axios;