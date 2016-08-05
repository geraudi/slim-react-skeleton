/**
 * Created by geraud on 29/07/2016.
 */

import * as authActions from './actions';
import axios from '../../../lib/api';

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
                url: 'auth',
                method: 'post',
                data: {
                    credential: credential,
                    password: password
                },
            })
                .then(function (response) {
                    response.data.success
                        ? dispatch(authActions.loginSuccess(response.data.token, response.data.user))
                        : dispatch(authActions.loginFail(response.data.message));
                })
                .catch(function (error) {
                    dispatch(authActions.loginFail('Sorry, try later...'));
                })
        }
    }
}


export function register(registrationData) {

    return (dispatch) => {

        dispatch(authActions.registrationRequest(registrationData));

        return axios({
            url: 'users',
            method: 'post',
            data: {...registrationData},
        })
            .then(function (response) {
                response.data.success
                    ? dispatch(authActions.registrationSuccess(response.data.user))
                    : dispatch(authActions.registrationFail(response.data.message));
            })
            .catch(function (error) {
                dispatch(authActions.loginFail('Sorry, try later...'));
            })
    }
}


export function testJwt() {

    return (dispatch, getState) => {

        return axios({
            url: 'users/' + getState().auth.user.id,
            method: 'get',
            headers: {'Authorization': `Bearer ${getState().auth.token}`}
        })
            .then(function (response) {
                response.data.success ? console.debug('ok') : console.debug('ko');
            })
            .catch(function (error) {
                console.log(error);
            })
    }
}

export function getLastAlbum() {

    return (dispatch, getState) => {

        return axios({
            url: 'users/' + getState().auth.user.id,
            method: 'get',
            headers: {'Authorization': `Bearer ${getState().auth.token}`}
        })
            .then(function (response) {
                response.data.success ? console.debug('ok') : console.debug('ko');
            })
            .catch(function (error) {
                console.log(error);
            })
    }
}