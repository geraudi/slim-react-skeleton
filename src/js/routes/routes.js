/**
 * Created by geraud on 24/07/2016.
 */

import React from 'react';
import {Router, Route, IndexRoute} from 'react-router';
import App from '../App';
import Home from './Home';
import Explore from './Explore';
import LoginContainer from './Auth/LoginContainer';
import LogoutContainer from './Auth/LogoutContainer';


module.exports = (
    <Route path="/" component={App}>
        <IndexRoute component={Home} />
        <Route path="/explore" component={Explore} />
        <Route path="/auth/login" component={LoginContainer} />
        <Route path="/auth/logout" component={LogoutContainer} />
    </Route>
);

