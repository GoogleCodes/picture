//  webpack生产环境配置
//  node的路径模块
var path = require('path')
var utils = require('./utils')
var webpack = require('webpack')
var config = require('../config')
//  通过merge方法合并webpack.base.conf.js基础配置
var merge = require('webpack-merge')
var baseWebpackConfig = require('./webpack.base.conf')
var CopyWebpackPlugin = require('copy-webpack-plugin')
var HtmlWebpackPlugin = require('html-webpack-plugin')
//  这个是构建页面资源的插件
var ExtractTextPlugin = require('extract-text-webpack-plugin')
var OptimizeCSSPlugin = require('optimize-css-assets-webpack-plugin')

var env = process.env.NODE_ENV === 'testing'
  ? require('../config/test.env')
  : config.build.env

var webpackConfig = merge(baseWebpackConfig, {
  module: { //  此处调用了utils.styleLoaders
    rules: utils.styleLoaders({
      sourceMap: config.build.productionSourceMap,
      extract: true
    })
  },
  devtool: config.build.productionSourceMap ? '#source-map' : false,
  output: {
    //  输出路径
    path: config.build.assetsRoot,
    //  打包的js命名
    filename: utils.assetsPath('js/[name].[chunkhash].js'),
    //  非主文件的命名规则，加缓存用到md5
    chunkFilename: utils.assetsPath('js/[id].[chunkhash].js')
  },
  plugins: [
    // http://vuejs.github.io/vue-loader/en/workflow/production.html
    new webpack.DefinePlugin({  //  配置全局环境为生产环境
      'process.env': env
    }),
    //  js文件压缩插件
    new webpack.optimize.UglifyJsPlugin({
      //  压缩配置
      compress: {
        warnings: false
      },
      sourceMap: true //  生成sourceMap文件
    }),
    // extract css into its own file
    // 将js中引入的css分离的插件
    new ExtractTextPlugin({
      //  分离出的css文件名
      filename: utils.assetsPath('css/[name].[contenthash].css')
    }),
    // Compress extracted CSS. We are using this plugin so that possible
    // duplicated CSS from different components can be deduped.
    //  压缩提取出的css，并解决ExtractTextPlugin分离出的js重复问题(多个文件引入同一css文件)
    new OptimizeCSSPlugin({
      cssProcessorOptions: {
        safe: true
      }
    }),
    // generate dist inside.html with correct asset hash for caching.
    // you can customize output by editing /inside.html
    // see https://github.com/ampedandwired/html-webpack-plugin
    //  生成html的插件,引入css文件和js文件
    new HtmlWebpackPlugin({
      //  生成的html的文件名
      filename: process.env.NODE_ENV === 'testing'
        ? 'index.html'
        : config.build.index,
      //  依据的模板
      template: 'index.html',
      //  注入的js文件将会被放在body标签中,当值为'head'时，将被放在head标签中
      inject: true,
      //  压缩配置
      minify: {
        removeComments: true, //  删除html中的注释代码
        collapseWhitespace: true, //  删除html中的空白符
        removeAttributeQuotes: true // 删除html元素中属性的引号
        // more options:
        // https://github.com/kangax/html-minifier#options-quick-reference
      },
      // necessary to consistently work with multiple chunks via CommonsChunkPlugin
      //  按dependency的顺序引入
      chunksSortMode: 'dependency'
    }),
    // keep module.id stable when vender modules does not change
    new webpack.HashedModuleIdsPlugin(),
    // split vendor js into its own file
    //  分离公共js到vendor中
    new webpack.optimize.CommonsChunkPlugin({
      //  文件名
      name: 'vendor',
      //  声明公共的模块来自node_modules文件夹
      minChunks: function (module, count) {
        // any required modules inside node_modules are extracted to vendor
        return (
          module.resource &&
          /\.js$/.test(module.resource) &&
          module.resource.indexOf(
            path.join(__dirname, '../node_modules')
          ) === 0
        )
      }
    }),
    // extract webpack runtime and module manifest to its own file in order to
    // prevent vendor hash from being updated whenever app bundle is updated
    //  上面虽然已经分离了第三方库,每次修改编译都会改变vendor的hash值，导致浏览器缓存失效。
    //  原因是vendor包含了webpack在打包过程中会产生一些运行时代码，运行时代码中实际上保存了打包后的文件名。
    //  当修改业务代码时,业务代码的js文件的hash值必然会改变。一旦改变必然会导致vendor变化。vendor变化会导致其hash值变化。
    //  下面主要是将运行时代码提取到单独的manifest文件中，防止其影响vendor.js
    new webpack.optimize.CommonsChunkPlugin({
      name: 'manifest',
      chunks: ['vendor']
    }),
    // copy custom static assets
    //  复制静态资源,将static文件内的内容复制到指定文件夹
    new CopyWebpackPlugin([
      {
        from: path.resolve(__dirname, '../static'),
        to: config.build.assetsSubDirectory,
        ignore: ['.*']
      }
    ])
  ]
})

//  额外配置
//  配置文件开启了gzip压缩
if (config.build.productionGzip) {
  //  引入压缩文件的组件,该插件会对生成的文件进行压缩，生成一个.gz文件
  var CompressionWebpackPlugin = require('compression-webpack-plugin')

  webpackConfig.plugins.push(
    //  目标文件名
    new CompressionWebpackPlugin({
      //  使用gzip压缩
      asset: '[path].gz[query]',
      //  满足正则表达式的文件会被压缩
      algorithm: 'gzip',
      test: new RegExp(
        '\\.(' +
        config.build.productionGzipExtensions.join('|') +
        ')$'
      ),
      //  资源文件大于10240B=10kB时会被压缩
      threshold: 10240,
      //  最小压缩比达到0.8时才会被压缩
      minRatio: 0.8
    })
  )
}

if (config.build.bundleAnalyzerReport) {
  var BundleAnalyzerPlugin = require('webpack-bundle-analyzer').BundleAnalyzerPlugin
  webpackConfig.plugins.push(new BundleAnalyzerPlugin())
}

module.exports = webpackConfig
