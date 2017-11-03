/**
 * Created by SamHong on 2017/10/12.
 */
//  主页商品
exports.index_def = '../../../static/data/index.json'
//  获取导航栏
exports.GET_NAV = '/api/home/front/getPrdClassify'
//  相册系列
exports.album = '/api/home/index/index'
//  获取新闻信息
exports.GET_NEWS = '/api/portal/articles'
//  订单列表
exports.GET_ORDER = '/api/home/front/goodsList'
//  订单详情数据
exports.GET_STOP_MSG = '/api/home/front/getgoods'
//  规格
exports.GET_SPECIF = '/api/home/front/speclist'
//  增加商品到购物车
exports.POST_CART_DATA = '/api/home/shopcar/add'
//  获取数据
exports.GET_CART_TODATA = '/api/home/shopcar/getById'
//  获取购物车数据
exports.GET_CART_DATA = '/api/home/shopcar/getByUid'
//  删除购物车商品
exports.DELETE_CART_DATA = '/api/home/shopcar/del'
//  获取规格
exports.GET_POST_PRICE = '/api/home/shopcar/price'