import React, {Component, PropTypes} from 'react';

export default class Logout extends Component {

    constructor(props) {
        super(props);
    }

    static propTypes = {
        onLogoutRequest: PropTypes.func.isRequired
    };

    componentWillMount() {
        this.props.onLogoutRequest();
    }

    componentWillReceiveProps(nextProps) {
        if(nextProps.auth.isAuthenticated && nextProps.auth.user) {
            this.props.router.push('/');
        }
    }

    render() {

        return (
            <div>
                <h1>Logout</h1>
                Bye...
            </div>
        );
    }
}
