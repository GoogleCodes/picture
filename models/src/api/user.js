// 用户请求数据配置
import fetch from '../common/fetch'
import { port_user } from '../common/port_uri'

//登录
export function login(data) {
  return fetch({
    url: port_user.login,
    method: 'post',
    data
  })
}
