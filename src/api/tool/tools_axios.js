/**
 * Created by SamHong on 2017/11/10.
 */

import axios from 'axios'
import qs from 'qs'
import get_api from '../../common/port_uri'
import { Message } from 'element-ui'

export default new class GoAxios {
  /**
   * 构造函数
   */
  constructor() {
    this.init()
  }

  /**
   * 初始化
   */
  init() {
    axios.defaults.baseURL = get_api.get_http_ip.GET_YUYIN_HTTP
  }

  /**
   * 
   * @param {*提示错误} data 
   */
  _error(data) {
    Message.error('网络错误')
  }

  _isStatus(data) {
    console.log(data);
  }

  /**
   * 
   * @param {*url 连接地址} target 
   * @param {* 发送的数据} data 
   */
  HttpGet(target, data){
    if (data) {
      var params = [];
      for (var i in data) {
        params.push(i);
        params.push(data[i])
      }
      target = target + '/' + params.join('/')
    }
    return new Promise((resolve, reject) => {
      axios({
        url: get_api.get_http_ip.GET_YUYIN_HTTP + 'public' + target,
        method: 'get',
        withCredentials: false
      }).then(function (response) {
        if (response.data == get_api.get_code.error) {
          Message.warning(response.data.msg)
        } else if (response.data.code == get_api.get_code.success) {
          Message.success(response.data.msg)
          resolve(response.data)
        }
      }).catch(function (error) {
        this._error(error);
      })
    })
  }

  /**
   * 
   * @param {* url信息} target 
   * @param {* 发送的数据} data 
   */
  HttpPost(target, data) {
    return new Promise((resolve, reject) => {
      var postData = qs.stringify(data);
      axios({
        url: get_api.get_http_ip.HTTP_IP + 'public' + target,
        method: 'post',
        data: postData,
        withCredentials: false
      }).then(function (response) {
        if (response.data.code == get_api.get_code.error) {
          Message.warning(response.data.msg)
        } else if (response.data.code == get_api.get_code.success) {
          Message.success(response.data.msg)
          resolve(response.data)
        }
      }).catch(function (error) {
        this._error(error);
      })
    })
  }

}