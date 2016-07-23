/**
 * Created by geraud on 23/07/2016.
 */
var React = require('react');
var TestUtils = require('react/lib/ReactTestUtils'); //I like using the Test Utils, but you can just use the DOM API instead.
var expect = require('expect');
import App from '../App';


describe('app', function () {
    it('renders without problems', function () {
        var app = TestUtils.renderIntoDocument(<App />);
        expect(app).toExist();
    });
});