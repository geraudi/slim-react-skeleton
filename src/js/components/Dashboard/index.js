/**
 * Created by geraud on 01/08/2016.
 */

import React, {Component, PropTypes} from 'react';
import { connect } from 'react-redux';
import { withRouter } from 'react-router';

import { testJwt } from '../../store/actions/auth/thunks';

class Dashboard extends Component {

    constructor(props) {
        super(props);
        this._redirect = this._redirect.bind(this);
    }

    static propTypes = {
        auth: PropTypes.object.isRequired
    };

    componentDidMount() {
        this._redirect(this.props);
        this.props.onTestJwt();
    }

    componentWillReceiveProps(nextProps) {
        this._redirect(nextProps);
    }

    _redirect(props) {
        if (props.auth.isAuthenticated == false) {
            this.props.router.push('/');
        }
    }

    render() {
        return (
            <h1>Dashboard...</h1>
        );
    }
}


const mapStateToProps = (state) => {
    return {
        auth: state.auth
    }
};

export default withRouter(connect(mapStateToProps, { onTestJwt: testJwt })(Dashboard));