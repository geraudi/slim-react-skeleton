/*
 * action types
 */

import * as actionTypes from './types';


//------------------------------
// LOGIN
//------------------------------

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

//------------------------------
// LOGOUT
//------------------------------

export function logoutSuccess() {
    return {
        type: actionTypes.LOGOUT_SUCCESS
    }
}


//------------------------------
// REGISTRATION
//------------------------------

export function registrationSuccess(user) {
    return {
        type: actionTypes.REGISTRATION_SUCCESS,
        user: user
    }
}

export function registrationRequest(registrationData) {
    return {
        type: actionTypes.REGISTRATION_REQUEST,
        registrationData: registrationData

    }
}

export function registrationFail(message) {
    return {
        type: actionTypes.REGISTRATION_FAILURE,
        message: message
    }
}






