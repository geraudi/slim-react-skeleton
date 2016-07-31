/**
 * Created by geraud on 05/02/2016.
 */

import React, {Component, PropTypes } from 'react';
import { connect } from 'react-redux';
import { withRouter } from 'react-router';

import Logout from './Logout';
import { logout } from '../../redux/actions/auth/actionsAsync';

const mapStateToProps = (state) => {
    return {
        auth: state.auth
    }
};

const mapDispatchToProps = (dispatch) => {
    return {
        onLogoutRequest: (credential, password) => {
            dispatch(logout())
        }
    }
};

export default withRouter(connect(mapStateToProps, mapDispatchToProps)(Logout));