let merge = require('webpack-merge')
let prodEnv = require('./prod.env')

module.exports = merge(prodEnv, {
    NODE_ENV: '"development"'
})
