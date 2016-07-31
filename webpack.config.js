var path = require('path');
var webpack = require("webpack");
var node_modules = path.resolve(__dirname, 'node_modules');
var autoprefixer = require('autoprefixer');


module.exports = {

    entry: [
        'webpack-dev-server/client?http://127.0.0.1:8080',
        'webpack/hot/only-dev-server',
        './src/js/index.js',
    ],

    output: {
        path: path.join(__dirname, 'public/js'),
        filename: 'bundle.js',
        publicPath: 'http://127.0.0.1:8080/js/'
    },

    resolve: {
        extensions: ['', '.js', '.jsx']
    },

    module: {
        loaders: [
            {
                test: /\.jsx?$/,
                loaders: ['react-hot','babel-loader'],
                exclude: /node_modules/
            },
            {
                test: /\.scss$/,
                loaders: ['style', 'css', 'postcss', 'sass']
            },
            {
                test: /\.css$/, // Only .css files
                loaders: ['style', 'css', 'postcss'] // Run both loaders
            }
        ]
    },

    postcss: function () {
        return [autoprefixer];
    },

    plugins: [
        new webpack.HotModuleReplacementPlugin(),
        new webpack.NoErrorsPlugin()
    ],

    devtool: 'source-map',
    debug: true
};
