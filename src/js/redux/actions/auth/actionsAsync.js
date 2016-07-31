/**
 * Created by geraud on 29/07/2016.
 */

import * as authActions from './actions';
import axios from 'axios';

const BASE_URL = "http://my-skeleton-mvc.local/api/v1/auth";

const LOCAL_STORAGE_KEY = 'auth';


/**
 * Send token request.
 * response :
 * {
 *    success: boolean,
 *    token: string,
 *    user: object,
 *    message: string
 * }
 *
 * @param credential
 * @param password
 * @returns {function()}
 */
export function login(credential, password) {

    return (dispatch) => {

        if (credential && password) {

            dispatch(authActions.loginRequest(credential, password));

            return axios({
                url: BASE_URL,
                timeout: 20000,
                method: 'post',
                responseType: 'json',
                data: {
                    credential: credential,
                    password: password
                },
                validateStatus: function (status) {
                    return status < 500; // Reject only if the status code is greater than or equal to 500
                }
            })
                .then(function (response) {
                    if (response.data.success) {
                        localStorage.setItem(LOCAL_STORAGE_KEY, response.data);
                        dispatch(authActions.loginSuccess(response.data.token, response.data.user));
                    } else {
                        dispatch(authActions.loginFail(response.data.message));
                    }
                })
                .catch(function (error) {

                    // if (error.response) {
                    // The request was made, but the server responded with a status code
                    // that falls out of the range of 2xx
                    // console.log(error.response.data);
                    // console.log(error.response.status);
                    // console.log(error.response.headers);
                    // } else {
                    //     Something happened in setting up the request that triggered an Error
                    //     console.log('Error', error.message);
                    // }
                    // console.log(error.config);
                    // dispatch(authActions.loginServerFail(error.response.data));
                })

        }
    }
}

export function checkLogin() {

    return (dispatch) => {

        if ((localStorage.getItem(LOCAL_STORAGE_KEY))) {
            let auth = localStorage.getItem(LOCAL_STORAGE_KEY);
            dispatch(authActions.loginSuccess(auth.token, auth.user));
            return;
        }
    }
}

export function logout(credential, password) {

    return (dispatch) => {

        if ((localStorage.getItem(LOCAL_STORAGE_KEY))) {
            let auth = localStorage.removeItem(LOCAL_STORAGE_KEY);
            dispatch(authActions.logoutSuccess());
        }
    }
}
