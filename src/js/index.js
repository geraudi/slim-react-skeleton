import React from 'react';
import {render} from 'react-dom';
import {Provider} from 'react-redux';

import store from './store';
import AppRouter from './components/AppRouter';

import 'purecss/build/pure.css';
import "../stylesheet/index.scss";

render(
    <Provider store={store}>
        <AppRouter />
    </Provider>,
    document.getElementById('app')
);