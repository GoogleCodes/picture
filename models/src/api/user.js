// 用户请求数据配置
import { tools_axios } from '../api/tool'
import { port_user, get_content } from '../common/port_uri'

//登录
export function login(data) {
  return tools_axios.fetch({
    url: get_content.GET_NAV,
    method: 'get',
    data
  })
}
