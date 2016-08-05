/**
 * Created by geraud on 04/08/2016.
 */
import React, {Component, PropTypes} from 'react';
import {Router, Route, IndexRoute, browserHistory} from "react-router";
import {connect} from 'react-redux';

import authPropTypes from '../store/propTypes/auth';
/**
 * First level component
 */
import Root from './Root';
import Home from './Home';
import Explore from './Explore';
import Dashboard from './Dashboard';
import Login from './Auth/Login';
import Logout from './Auth/Logout';
import Registration from './Auth/Registration';

class AppRouter extends Component {

    constructor(props) {
        super(props);

        this._requireNotAuth = this._requireNotAuth.bind(this);
        this._requireAuth = this._requireAuth.bind(this);
        this._isAuth = this._isAuth.bind(this);

        this.routes = (
            <Route path="/" component={Root}>
                <IndexRoute component={Home}/>
                <Route path="/explore" component={Explore}/>
                <Route path="/dashboard" component={Dashboard}/>
                <Route path="/auth/login" component={Login} onEnter={this._requireNotAuth}/>
                <Route path="/auth/logout" component={Logout} onEnter={this._requireAuth}/>
                <Route path="/auth/registration" component={Registration} onEnter={this._requireNotAuth}/>
            </Route>
        );
    }

    static propTypes = {
        auth: authPropTypes
    };

    _requireAuth(nextState, replace) {
        if (!this._isAuth()) {
            replace('/');
        }
    }

    _requireNotAuth(nextState, replace) {
        if (this._isAuth()) {
            replace('/');
        }
    }

    _isAuth() {
        return this.props.auth.isAuthenticated && this.props.auth.user && this.props.auth.token;
    }

    render() {
        return (
            <Router history={browserHistory} routes={ this.routes }/>
        )
    }
}

const mapStateToProps = (state) => {
    return {
        auth: state.auth
    }
};

export default connect(mapStateToProps)(AppRouter);
