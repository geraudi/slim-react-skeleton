/**
 * Created by geraud on 26/07/2016.
 */

import * as authActionTypes from '../actions/auth/actionTypes'



export default function auth(state = {isAuthenticated: false, user: {}, errors: []}, action) {

    switch (action.type) {

        case authActionTypes.LOGIN_REQUEST:
            return Object.assign({}, state, {
                isAuthenticated: false,
                errors: []
            });

        case authActionTypes.LOGIN_SUCCESS:
            return Object.assign({}, state, {
                isAuthenticated: true,
                user: action.user,
                token: action.token,
                errors: []
            });

        case authActionTypes.LOGIN_FAILURE:
            return Object.assign({}, state, {
                isAuthenticated: false,
                user: {},
                errors: [action.message]
            });

        case authActionTypes.LOGOUT_SUCCESS:
            return Object.assign({}, state, {
                isAuthenticated: false,
                errors: [],
                user: {}
            });

        default:
            return state
    }
}

