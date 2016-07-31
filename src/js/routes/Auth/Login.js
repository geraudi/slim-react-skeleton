import React, {Component, PropTypes} from 'react';

export default class Login extends Component {

    constructor(props) {

        super(props);

        this._onChangeCredential = this._onChangeCredential.bind(this);
        this._onChangePassword = this._onChangePassword.bind(this);
        this._onSubmit = this._onSubmit.bind(this);

        this.state = {
            credential: 'email',
            password: 'password',
            hasChange: true,
            hasError: false,
            canValidate: true,
            errorMessage: {
                credential: '',
                password: ''
            }
        }
    }

    static propTypes = {
        onLoginRequest: PropTypes.func.isRequired
    };

    componentWillReceiveProps(nextProps) {
        if(nextProps.auth.isAuthenticated && nextProps.auth.user) {
            this.props.router.push('/');
        }
    }

    render() {

        return (
            <div>
                <h1>Login</h1>
                <div>
                    <label htmlFor="credential">Login : </label>
                    <input name="credential"
                           type="text"
                           id="credential"
                           value={this.state.credential}
                           onChange={this._onChangeCredential}/>
                </div>

                <div>
                    <label htmlFor="password">Password : </label>
                    <input name="password"
                           type="text"
                           id="password"
                           value={this.state.password}
                           onChange={this._onChangePassword}/>
                </div>

                <div>
                    <button disabled={!this.state.canValidate} onClick={this._onSubmit}>Connection</button>
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
        // this.context.router.push('/');
        if (!this.state.hasError) {
            console.debug(this.state);
            this.props.onLoginRequest(this.state.credential,this.state.password)
        }
    }
}
