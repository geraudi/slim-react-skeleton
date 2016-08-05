import React, {Component, PropTypes} from 'react';
import {connect}     from 'react-redux';
import {withRouter}  from 'react-router';

import authPropTypes from '../../store/propTypes/auth';
import {register}    from '../../store/actions/auth/thunks';
import FormError     from '../_commons/FormError';

class Registration extends Component {

    constructor(props) {
        super(props);

        this._onChangeUsername = this._onChangeUsername.bind(this);
        this._onChangeEmail = this._onChangeEmail.bind(this);
        this._onChangePassword = this._onChangePassword.bind(this);
        this._onChangeConfirmPassword = this._onChangeConfirmPassword.bind(this);
        this._onSubmit = this._onSubmit.bind(this);

        this.state = {
            registrationData: {
                username: '',
                email: '',
                password: ''
            },
            confirmPassword: '',
            canValidate: true,
            errorMessage: {
                username: '',
                email: '',
                password: '',
                confirmPassword: ''
            }
        }
    }

    static propTypes = {
        auth: authPropTypes,
        onRegistrationRequest: PropTypes.func.isRequired
    };

    componentWillReceiveProps(nextProps) {
        if (nextProps.auth.isAuthenticated) {
            this.props.router.push('/');
        }
    }

    render() {

        return (
            <div className="pure-form">
                <h1>Registration</h1>
                <div>
                    <label htmlFor="username">Login : </label>
                    <input name="username"
                           type="text"
                           id="username"
                           value={this.state.registrationData.username}
                           onChange={this._onChangeUsername}/>
                    <FormError message={this.state.errorMessage.username}/>
                </div>

                <div>
                    <label htmlFor="email">email : </label>
                    <input name="email"
                           type="text"
                           id="email"
                           value={this.state.registrationData.email}
                           onChange={this._onChangeEmail}/>
                    <FormError message={this.state.errorMessage.email}/>
                </div>


                <div>
                    <label htmlFor="password">Password : </label>
                    <input name="password"
                           type="password"
                           id="password"
                           value={this.state.registrationData.password}
                           onChange={this._onChangePassword}/>
                    <FormError message={this.state.errorMessage.password}/>

                </div>

                <div>
                    <label htmlFor="confirm_password">Confirm password : </label>
                    <input name="confirm_password"
                           type="password"
                           id="confirm_password"
                           value={this.state.confirmPassword}
                           onChange={this._onChangeConfirmPassword}/>
                    <FormError message={this.state.errorMessage.confirmPassword}/>

                </div>

                <div>
                    <button className="pure-button pure-button-primary" disabled={!this.state.canValidate}
                            onClick={this._onSubmit}>Registration
                    </button>
                </div>
            </div>
        );
    }

    _onChangeUsername(event) {
        var newState = Object.assign({}, this.state);
        newState.registrationData.username = event.target.value;
        this.setState(newState);
    }

    _onChangeEmail(event) {
        var newState = Object.assign({}, this.state);
        newState.registrationData.email = event.target.value;
        this.setState(newState);
    }

    _onChangePassword(event) {
        var newState = Object.assign({}, this.state);
        newState.registrationData.password = event.target.value;
        this.setState(newState);
    }

    _onChangeConfirmPassword(event) {
        var newState = Object.assign({}, this.state);
        newState.confirmPassword = event.target.value;
        this.setState(newState);
    }

    _onSubmit(event) {
        event.preventDefault();
        if (this.state.registrationData.password != this.state.confirmPassword) {
            var newState = Object.assign({}, this.state);
            newState.errorMessage.confirmPassword = 'Not match with password';
            this.setState(newState);
        } else {
            if (!this.state.hasError) {
                console.debug(this.state);
                this.props.onRegistrationRequest(this.state.registrationData)
            }
        }
    }
}

const mapStateToProps = (state) => {
    return {
        auth: state.auth
    }
};

const mapDispatchToProps = (dispatch) => {
    return {
        onRegistrationRequest: (registrationData) => {
            dispatch(register(registrationData))
        }
    }
};

export default withRouter(connect(mapStateToProps, {onRegistrationRequest: register})(Registration));