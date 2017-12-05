//cookie存储类
//存储前缀
import { storage_prefix } from '../../common/config'
import { tool_verify } from '../../api/tool'
import { tools_uri } from '../../api/tool'

/**
 * cookies操作类
 */
class Tools_Cookies {

  /**
   * 构造函数
   */
  constructor() {
    this.defaults = {}
    this.expiresMultiplier = 60 * 60 * 24
    this.prefix = storage_prefix
  }


  /**
   * 根据key获取cookie的值
   * @param {string} key 键
   * @returns {object} 值
   */
  get(key) {
    if(!key) {
      throw new Error('没有找到key。')
      return
    }
    if (typeof key === 'object') {
      throw new Error('key不能是一个对象。')
      return
    }
    let cookies = this.all()
    let value = cookies[this.prefix + key]
    try {
      value = JSON.parse(value)
    } catch (e) {
      value = {}
    }
    return value
  }

  /**
   * 设置cookies
   * @param key 键
   * @param value 值
   * @param options 选项
   * @returns {Cookie}
   */
  set(key, value, options) {
    options = tool_verify.isObject(options) ? options : {expires: options}
    // 如果expires为空的话那么就设置为session.
    let expires = options.expires !== undefined ? options.expires : (this.defaults.expires || ''), expiresType = typeof(expires)
    if (expiresType === 'string' && expires !== '') {
      expires = new Date(expires)
    } else if (expiresType === 'number') {
      expires = new Date(+new Date + 1000 * this.expiresMultiplier * expires)
    }
    if (expires !== '' && 'toGMTString' in expires) {
      expires = ';expires=' + expires.toGMTString()
    }
    //设置path
    let path = options.path || this.defaults.path
    path = path ? ';path=' + path : ''
    //设置domain
    let domain = options.domain || this.defaults.domain
    domain = domain ? ';domain=' + domain : ''
    //设置secure
    let secure = options.secure || this.defaults.secure ? ';secure' : ''
    if (options.secure === false) secure = ''
    //设置cookie
    document.cookie = tools_uri.encode(this.prefix + key) + '=' + tools_uri.encode(JSON.stringify(value)) + expires + path + domain + secure
    return this
  }

  /**
   * 删除cookie
   * @param {string||array} keys 删除cookie的key
   * @returns {Cookie}
   */
  remove(keys) {
    keys = tool_verify.isArray(keys) ? keys : [keys]
    for (let i = 0, l = keys.length; i < l; i++) {
      this.set(keys[i], '', -1);
    }
    return this
  }

  /**
   * 获取所有的cookie
   * @returns {object} cookie对象
   */
  all() {
    let cookie = document.cookie
    if (cookie === '') return {}
    let cookieArr = cookie.split('; '),
      result = {}
    for (let i = 0, l = cookieArr.length; i < l; i++) {
      let item = cookieArr[i].split('=');
      //arr.shift()把第一个数组删除并得到删除的值
      let key = tools_uri.decode(item.shift())
      let value = tools_uri.decode(item.join(''))
      result[key] = value
    }
    return result
  }

  getCookie(cookie_name) {
    var allcookies = document.cookie;
    var cookie_pos = allcookies.indexOf(cookie_name);   //索引的长度
    // 如果找到了索引，就代表cookie存在，
    // 反之，就说明不存在。
    if (cookie_pos != -1) {
      // 把cookie_pos放在值的开始，只要给值加1即可。
      cookie_pos += cookie_name.length + 1;      //这里容易出问题，所以请大家参考的时候自己好好研究一下
      var cookie_end = allcookies.indexOf(";", cookie_pos);
      if (cookie_end == -1){
        cookie_end = allcookies.length;
      }
      var value = unescape(allcookies.substring(cookie_pos, cookie_end));         //这里就可以得到你想要的cookie的值了。。。
    }
    return value;
  }
}

export const cookieStorage = new Tools_Cookies()
