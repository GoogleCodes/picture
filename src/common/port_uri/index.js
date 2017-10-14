
//  登录 注册
const port_user = require("./user")
//  首页内容
const get_content = require('./content');
//  浏览其他
const get_other = require('./other');

//  收货地址
const get_address = require('./address');

module.exports = {
  port_user,
  get_content,
  get_other,
  get_address
}
