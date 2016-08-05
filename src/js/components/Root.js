/**
 * Main layout
 */
import React, { Component } from 'react';

import TopBar from './_commons/topBar';


export default class Root extends Component {
    render() {
        return (
            <div>
               <TopBar />
                <div className="content-wrapper">
                    {this.props.children}
                </div>
            </div>
        );
    }
};