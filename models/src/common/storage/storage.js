/**
 * Created by SamHong on 2017/10/9.
 */

//  Storage工具类
//  存储前缀
import {storage_prefix} from '../../common/config'
import { tool_verify } from '../../api/tool'
import { tools_uri } from '../../api/tool'


class Storage {

  constructor(type) {
    if (type == 'local') {
      this.store = window.localStorage
    } else if (type == 'session') {
      this.store = window.sessionStorage
    }
    this.prefix = storage_prefix
  }

  /**
   * 
   * @param {* key} key 
   * @param {* value} value 
   */
  set(key, value) {
    try {
      value = JSON.stringify(value)
    } catch (e) {
      value = value
    }
    this.store.setItem(tools_uri.encode(this.prefix + key), tools_uri.encode(value))
    window.localStorage.setItem(key,value);
    return this
  }

  /**
   * 
   * @param {* key} key 
   */
  get(key) {
    if (!key) {
      throw new Error('没有找到key。')
      return
    }
    if (typeof key == 'object') {
      throw new Error('key不能是一个对象。')
      return
    }
    let value = this.store.getItem(tools_uri.encode(this.prefix + key))
  
    if (value == null) {
      return {}
    }
  
    try {
      value = JSON.parse(tools_uri.decode(value))
    } catch (e) {
      value = {}
    }
    return value
  }
  
  remove(key) {
    this.store.removeItem(tools_uri.encode(this.prefix + key))
    return this
  }
}

export const localStorage = new Storage('local')
export const sessionStorage = new Storage('session')