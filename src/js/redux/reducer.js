import { combineReducers } from 'redux';
import auth from './reducers/auth';
import entities from './reducers/entities';

const rootReducer = combineReducers({
    auth,
    entities
});

export default rootReducer;