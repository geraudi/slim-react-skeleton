import {applyMiddleware, createStore} from 'redux';
import thunk from 'redux-thunk';
import createLogger from 'redux-logger';
import throttle from 'lodash/throttle';
import rootReducer from './reducer.js';

import {loadState, saveState} from '../lib/localStorage';

const persistedState = loadState();

const logger = createLogger();

const store = createStore(
    rootReducer,
    persistedState,
    applyMiddleware(thunk, logger),
);

store.subscribe(
    throttle(() => {
        saveState({
            auth: store.getState().auth
        });
    }, 1000)
);

export default store

