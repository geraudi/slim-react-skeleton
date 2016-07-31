/**
 * Created by geraud on 26/07/2016.
 */
import { combineReducers } from 'redux';
import albums from './entities/albums';

const entitiesReducer = combineReducers({
    albums
});

export default entitiesReducer;