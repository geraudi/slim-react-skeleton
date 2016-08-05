import React, {Component, PropTypes} from 'react';
import {connect} from 'react-redux';
import {withRouter} from 'react-router';

import authPropTypes from '../../store/propTypes/auth';


import {login} from '../../store/actions/auth/thunks';

class Login extends Component {

    constructor(props) {

        super(props);
        this._onChangeCredential = this._onChangeCredential.bind(this);
        this._onChangePassword = this._onChangePassword.bind(this);
        this._onSubmit = this._onSubmit.bind(this);

        this.state = {
            credential: '',
            password: '',
            hasChange: true,
            hasError: false,
            canValidate: true,
            errorMessage: {
                credential: '',
                password: '',
                global: ''
            }
        }
    }

    static propTypes = {
        auth: authPropTypes,
        onLoginRequest: PropTypes.func.isRequired
    };

    componentWillReceiveProps(nextProps) {
        if (nextProps.auth.isAuthenticated) {
            this.props.router.push('/');
        }
    }

    render() {

        return (
            <div>
                <h1>Login</h1>
                <div className="pure-form">
                    <div>
                        <label htmlFor="credential">E-mail (ou user name): </label>
                        <input name="credential"
                               type="text"
                               id="credential"
                               value={this.state.credential}
                               onChange={this._onChangeCredential}/>
                    </div>

                    <div>
                        <label htmlFor="password">Password: </label>
                        <input name="password"
                               type="password"
                               id="password"
                               value={this.state.password}
                               onChange={this._onChangePassword}/>
                    </div>

                    <div>
                        <button className="pure-button pure-button-primary" disabled={!this.state.canValidate} onClick={this._onSubmit}>Connection</button>
                    </div>
                </div>

            </div>
        );
    }

    _onChangeCredential(event) {
        var newState = Object.assign({}, this.state);
        newState.credential = event.target.value;
        this.setState(newState);
    }

    _onChangePassword(event) {
        var newState = Object.assign({}, this.state);
        newState.password = event.target.value;
        this.setState(newState);
    }

    _onSubmit(e) {
        e.preventDefault();
        if (!this.state.hasError) {
            this.props.onLoginRequest(this.state.credential, this.state.password)
        }
    }
}


const mapStateToProps = (state) => {
    return {
        auth: state.auth
    }
};

export default withRouter(connect(mapStateToProps, {onLoginRequest: login})(Login));
