/**
 * Created by geraud on 04/08/2016.
 */
import {PropTypes} from 'react';

export default PropTypes.shape({
    isAuthenticated: PropTypes.bool.isRequired,
    user: PropTypes.object,
    token: PropTypes.string,
    errors: PropTypes.arrayOf(PropTypes.string)
})