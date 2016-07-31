import { applyMiddleware, createStore } from 'redux';
import thunk from 'redux-thunk';
import createLogger from 'redux-logger';
import rootReducer from './reducer.js';

const logger = createLogger();

const store = createStore(
    rootReducer,
    applyMiddleware(thunk, logger)
);

export default store

