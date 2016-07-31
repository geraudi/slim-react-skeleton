/**
 * Created by geraud on 05/02/2016.
 */

import React, {Component, PropTypes } from 'react';
import { connect } from 'react-redux';
import { withRouter } from 'react-router';

import Login from './Login';
import { login } from '../../redux/actions/auth/actionsAsync';

const mapStateToProps = (state) => {
    return {
        auth: state.auth
    }
};

const mapDispatchToProps = (dispatch) => {
    return {
        onLoginRequest: (credential, password) => {
            dispatch(login(credential, password))
        }
    }
};

export default withRouter(connect(mapStateToProps, mapDispatchToProps)(Login));