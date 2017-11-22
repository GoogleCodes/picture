/**
 * Created by SamHong on 2017/11/10.
 */

import axios from 'axios'
import qs from 'qs'
import get_api from '../../common/port_uri'

export default new class GoAxios {

  /**
   * 构造函数
   */
  constructor() {
  }

  /**
   *
   * @param {*提示错误} data
   */
  _error(data) {

  }

  _isStatus(data) {
    if (data.code == get_api.get_code.error) {
      return false;
    } else if (data.code == get_api.get_code.success) {
      return true;
    }
  }

  /**
   *
   * @param {*url 连接地址} target
   * @param {* 发送的数据} data
   */
  HttpGet(target, data){
    let that = this;
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
        // `headers` 是即将被发送的自定义请求头
        headers: {'X-Requested-With': 'XMLHttpRequest'},
        // `withCredentials` 表示跨域请求时是否需要使用凭证
        withCredentials: false
      }).then(function (response) {
        if (that._isStatus(response.data)) {

        }
        resolve(response.data)
      }).catch(function (error) {
        reject()
        that._error(error);
      })
    })
  }

  /**
   *
   * @param {* url信息} target
   * @param {* 发送的数据} data
   */
  HttpPost(target, data) {
    let that = this;
    return new Promise((resolve, reject) => {
      var postData = qs.stringify(data);
      axios({
        url: get_api.get_http_ip.GET_YUYIN_HTTP + 'public' + target,
        method: 'post',
        data: postData,
        withCredentials: false
      }).then(function (response) {
        if (that._isStatus(response.data)) {

        }
        resolve(response.data)
      }).catch(function (error) {
        reject()
        that._error(error)
      })
    })
  }

  /**
   *
   * @param {* url信息} target
   * @param {* 发送的数据} data
   */
  HttpDelete(target, data) {
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
        method: 'delete',
        withCredentials: false
      }).then(function (response) {
        if (that._isStatus(response.data)) {
          resolve(response.data)
        }
      }).catch(function (error) {
        reject(error)
      })
    })
  }

}
