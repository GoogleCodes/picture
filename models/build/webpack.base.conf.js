//  webpack基础配置
//  node的路径模块
var path = require('path')
var utils = require('./utils')
var config = require('../config')
//  因为我们是vue.js的应用，把各个组件当做一个页面.vue后缀，所以引入这个可以编译這些文件
var vueLoaderConfig = require('./vue-loader.conf')

var webpack = require("webpack")

const vuxLoader = require('vux-loader')

// const vuxLoader = require('vux-loader')
// const webpackConfig = originalConfig

function resolve(dir) {
  return path.join(__dirname, '..', dir)
}

module.exports = {
  //  编译入口文件
  entry: {
    app: './src/main.js'
  },
  //  编译输出路径
  output: {
    //  输出路径
    path: config.build.assetsRoot,
    //  打包的js命名
    filename: '[name].js',
    //  指向异步加载的路径
    publicPath: process.env.NODE_ENV === 'production'
      ? config.build.assetsPublicPath
      : config.dev.assetsPublicPath
  },
  //  一些解决方案配置
  //  主要设置模块如何被解析。
  resolve: {
    //  自动解析确定的拓展名,使导入模块时不带拓展名
    extensions: ['.js', '.vue', '.json'],
    alias: {
      //  创建import或require的别名
      'vue$': 'vue/dist/vue.esm.js',
      '@': resolve('src'),
    }
  },
  module: {
    //  各种不同类型文件加载器配置
    rules: [{
      test: /\.vue$/,
      loader: 'vue-loader',
      options: vueLoaderConfig
    }, {//  js文件用babel转码
      test: /\.js$/,
      loader: 'babel-loader',
      include: [resolve('src'), resolve('test')],
      exclude: resolve('node_modules')
    }, {//  图片后缀
      test: /\.(png|jpe?g|gif|svg)(\?.*)?$/,
      loader: 'url-loader',
      options: {
        limit: 10000,
        name: utils.assetsPath('img/[name].[hash:7].[ext]')
      }
    }, {
      test: /\.(mp4|webm|ogg|mp3|wav|flac|aac)(\?.*)?$/,
      loader: 'url-loader',
      options: {
        limit: 10000,
        name: utils.assetsPath('media/[name].[hash:7].[ext]')
      }
    }, {
      test: /\.less$/,
      loader: 'style-loader!css-loader!less-loader'
    }, {//  字体文件
      test: /\.(woff2?|eot|ttf|otf)(\?.*)?$/,
      loader: 'url-loader',
      options: {
        limit: 10000,
        name: utils.assetsPath('fonts/[name].[hash:7].[ext]')
      }
    }]
  },plugins: [
    new webpack.optimize.CommonsChunkPlugin('common.js'),
    new webpack.ProvidePlugin({
      jQuery: "jquery",
      $: "jquery"
    })
  ]
}
