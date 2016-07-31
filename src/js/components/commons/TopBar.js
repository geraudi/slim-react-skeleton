/**
 * Created by geraud on 30/07/2016.
 */

import React, {Component} from 'react';
import {Link} from 'react-router';

export default class TopBar extends Component {

    render() {
        return (
            <div className="home-menu pure-menu pure-menu-horizontal pure-menu-fixed">

                <Link className="pure-menu-heading" to="/">Logo</Link>

                <ul className="pure-menu-list">
                    { this._getLink()}
                    <li className="pure-menu-item">
                        <Link activeClassName="pure-menu-selected" className="pure-menu-link"
                              to="/explore">Explore</Link>
                    </li>
                </ul>
            </div>
        );
    }

    _getLink() {

        if (this.props.isAuthenticated) {
            return (
                <li className="pure-menu-item">
                    <Link activeClassName="pure-menu-selected" className="pure-menu-link"
                          to="/auth/logout">Logout</Link>
                </li>
            )
        } else {
            return (
                <li className="pure-menu-item">
                    <Link activeClassName="pure-menu-selected" className="pure-menu-link"
                          to="/auth/login">Login</Link>
                </li>
            )
        }
    }


};