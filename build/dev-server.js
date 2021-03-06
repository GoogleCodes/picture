//  构建本地服务器
require('./check-versions')()

//  nodejs环境配置
var config = require('../config')
if (!process.env.NODE_ENV) {
  process.env.NODE_ENV = JSON.parse(config.dev.env.NODE_ENV)
}

//  强制打开浏览器
var opn = require('opn')
var path = require('path')
var express = require('express')
var webpack = require('webpack')
//  使用代理的中间件
var proxyMiddleware = require('http-proxy-middleware')
//  webpack的配置
var webpackConfig = (process.env.NODE_ENV === 'testing' || process.env.NODE_ENV === 'production')
  ? require('./webpack.prod.conf')
  : require('./webpack.dev.conf')

// default port where dev server listens for incoming traffic
//  端口号
var port = process.env.PORT || config.dev.port
// automatically open browser, if not set will be false
//  是否自动打开浏览器
var autoOpenBrowser = !!config.dev.autoOpenBrowser
// Define HTTP proxies to your custom API backend
// https://github.com/chimurai/http-proxy-middleware
//  http的代理url
var proxyTable = config.dev.proxyTable

//  启动express
var app = express()
//  webpack编译
var compiler = webpack(webpackConfig)

//  webpack-dev-middleware的作用
//  1.将编译后的生成的静态文件放在内存中,所以在npm run dev后磁盘上不会生成文件
//  2.当文件改变时,会自动编译。
//  3.当在编译过程中请求某个资源时，webpack-dev-server不会让这个请求失败，而是会一直阻塞它，直到webpack编译完毕
var devMiddleware = require('webpack-dev-middleware')(compiler, {
  publicPath: webpackConfig.output.publicPath,
  quiet: true
})

//  webpack-hot-middleware的作用就是实现浏览器的无刷新更新
var hotMiddleware = require('webpack-hot-middleware')(compiler, {
  log: false,
  heartbeat: 2000
})
// force page reload when html-webpack-plugin template changes

//  force page reload when html-webpack-plugin template changes
//  声明hotMiddleware无刷新更新的时机:html-webpack-plugin 的template更改之后
compiler.plugin('compilation', function (compilation) {
  compilation.plugin('html-webpack-plugin-after-emit', function (data, cb) {
    hotMiddleware.publish({ action: 'reload' })
    cb()
  })
})

//  proxy api requests
//  将代理请求的配置应用到express服务上
Object.keys(proxyTable).forEach(function (context) {
  var options = proxyTable[context]
  if (typeof options === 'string') {
    options = { target: options }
  }
  app.use(proxyMiddleware(options.filter || context, options))
})

// handle fallback for HTML5 history API
//  使用connect-history-api-fallback匹配资源
//  如果不匹配就可以重定向到指定地址
app.use(require('connect-history-api-fallback')())

// serve webpack bundle output
app.use(devMiddleware)

// enable hot-reload and state-preserving
// compilation error display
// 应用devMiddleware中间件
app.use(hotMiddleware)

// serve pure static assets
// 配置express静态资源目录
var staticPath = path.posix.join(config.dev.assetsPublicPath, config.dev.assetsSubDirectory)
app.use(staticPath, express.static('./static'))

//  编译成功后打印uri
var uri = 'http://localhost:' + port

var _resolve
var readyPromise = new Promise(resolve => {
  _resolve = resolve
})

console.log('> Starting dev server...')
devMiddleware.waitUntilValid(() => {
  console.log('> Listening at ' + uri + '\n')
  // when env is testing, don't need open it
  if (autoOpenBrowser && process.env.NODE_ENV !== 'testing') {
    opn(uri)
  }
  _resolve()
})

var server = app.listen(port)

//  启动express服务
module.exports = {
  ready: readyPromise,
  close: () => {
    server.close()
  }
}
