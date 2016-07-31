import React from 'react';
import {render} from 'react-dom';
import {Provider} from 'react-redux';
import {Router, browserHistory} from "react-router";

import store from './redux/store';
import routes from './routes/routes';

import { checkLogin } from './redux/actions/auth/actionsAsync';

import 'purecss/build/pure.css';
import "../stylesheet/index.scss";

render(
    <Provider store={store}>
        <Router history={browserHistory} routes={routes}/>
    </Provider>,
    document.getElementById('app')
);

store.dispatch(checkLogin());