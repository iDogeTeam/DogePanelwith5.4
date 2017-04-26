let utils = require('./utils')
let config = require('../webpack-config')
let isProduction = process.env.NODE_ENV === 'production'

module.exports = {
    loaders: utils.cssLoaders({
        sourceMap: isProduction
            ? config.build.productionSourceMap
            : config.dev.cssSourceMap,
        extract: isProduction
    })
}
