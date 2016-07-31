
import React, {Component, PropTypes } from 'react';
import { connect } from 'react-redux';

import TopBar from './TopBar';

const mapStateToProps = (state) => {
    return {
        ...state.auth
    }
};


export default connect(mapStateToProps)(TopBar);