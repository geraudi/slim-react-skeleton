/**
 * Main layout
 */
import React, { Component } from 'react';
import {Link} from 'react-router';

import TopBarContainer from './components/commons/topBarContainer';


export default class App extends Component {
    render() {
        return (
            <div>

               <TopBarContainer />

                <div className="content-wrapper">
                    {this.props.children}
                </div>
            </div>
        );
    }
};