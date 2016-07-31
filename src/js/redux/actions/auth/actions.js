/*
 * action types
 */

import * as actionTypes from './actionTypes';

export function loginSuccess(token, user) {
    return {
        type: actionTypes.LOGIN_SUCCESS,
        token: token,
        user: user
    }
}

export function loginRequest(credential, password) {
    return {
        type: actionTypes.LOGIN_REQUEST,
        credential: credential,
        password: password
    }
}

export function loginFail(message) {
    return {
        type: actionTypes.LOGIN_FAILURE,
        message: message
    }
}

export function logoutSuccess() {
    return {
        type: actionTypes.LOGOUT_SUCCESS
    }
}





