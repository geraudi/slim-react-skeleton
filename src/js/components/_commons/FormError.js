/**
 * Created by geraud on 30/07/2016.
 */

import React, {Component, PropTypes} from 'react';

const FormError = (props) => {
    return (
        <p>{props.message}</p>
    )
};

FormError.propTypes = {message: React.PropTypes.string};

export default FormError;