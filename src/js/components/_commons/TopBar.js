/**
 * Created by geraud on 30/07/2016.
 */

import React, {Component} from 'react';
import { connect } from 'react-redux';
import {Link} from 'react-router';

class TopBar extends Component {

    render() {
        return (
            <div className="home-menu pure-menu pure-menu-horizontal pure-menu-fixed">

                <Link className="pure-menu-heading" to="/">Logo</Link>

                { this._getLink() }

            </div>
        );
    }

    _getLink() {

        if (this.props.isAuthenticated) {
            return (
                <ul className="pure-menu-list">
                    <li className="pure-menu-item">
                        <Link activeClassName="pure-menu-selected" className="pure-menu-link"
                              to="/dashboard">Dashboard</Link>
                    </li>
                    <li className="pure-menu-item">
                        <Link activeClassName="pure-menu-selected" className="pure-menu-link"
                              to="/auth/logout">Logout</Link>
                    </li>
                    <li className="pure-menu-item">
                        <Link activeClassName="pure-menu-selected" className="pure-menu-link"
                              to="/explore">Explore</Link>
                    </li>
                </ul>
            )
        } else {
            return (
                <ul className="pure-menu-list">
                    <li className="pure-menu-item">
                        <Link activeClassName="pure-menu-selected" className="pure-menu-link"
                              to="/auth/login">Login</Link>
                    </li>
                    <li className="pure-menu-item">
                        <Link activeClassName="pure-menu-selected" className="pure-menu-link"
                              to="/auth/registration">Register</Link>
                    </li>
                    <li className="pure-menu-item">
                        <Link activeClassName="pure-menu-selected" className="pure-menu-link"
                              to="/explore">Explore</Link>
                    </li>
                </ul>
            )
        }
    }


};

const mapStateToProps = (state) => {
    return {
        ...state.auth
    }
};


export default connect(mapStateToProps)(TopBar);