// This is the webpack config used for unit tests.

let utils = require('./utils')
let webpack = require('webpack')
let merge = require('webpack-merge')
let baseConfig = require('./webpack.base.conf')

let webpackConfig = merge(baseConfig, {
    // use inline sourcemap for karma-sourcemap-loader
    module: {
        rules: utils.styleLoaders()
    },
    devtool: '#inline-source-map',
    plugins: [
        new webpack.DefinePlugin({
            'process.env': require('../webpack-config/test.env')
        })
    ]
})

// no need for app entry during tests
delete webpackConfig.entry

module.exports = webpackConfig
