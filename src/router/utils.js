/**
 * Created by SamHong on 2017/9/28.
 */
import axios from 'axios'
import qs from 'qs'
import get_api from '../common/port_uri'
import { Message } from 'element-ui'

//  get
export const fetchGet = (target, data) => {
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
      url: get_api.get_http_ip.HTTP_IP + 'public' + target,
      method: 'get',
      withCredentials: false
    }).then(function (response) {
      if (response.data.code == get_api.get_code.error) {
        Message.warning(response.data.msg)
      } else if (response.data.code == get_api.get_code.success) {
        Message.success(response.data.msg)
      }
      resolve(response.data)
    }).catch(function (error) {
      reject(error)
    })
  })
};




//  post
export const fetchPost = (target, data) => {
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
      }
      resolve(response.data)
    }).catch(function (error) {
      reject(error)
    })
  })
};

//  put
export const fetchPut = (target, data) => {
  return new Promise((resolve, reject) => {
    var postData = qs.stringify(data);
    axios({
      url: get_api.get_http_ip.HTTP_IP + 'public' + target,
      method: 'put',
      data: postData,
      withCredentials: false
    }).then(function (response) {
      if (response.data.code == get_api.get_code.error) {
        Message.warning(response.data.msg)
      } else if (response.data.code == get_api.get_code.success) {
        Message.success(response.data.msg)
      }
      resolve(response.data)
    }).catch(function (error) {
      reject(error)
    })
  })
};

//  delete
export const fetchDelete = (target, data) => {
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
      url: get_api.get_http_ip.HTTP_IP + 'public' + target,
      method: 'delete',
      withCredentials: false
    }).then(function (response) {
      if (response.data.code == get_api.get_code.error) {
        Message.warning(response.data.msg)
      } else if (response.data.code == get_api.get_code.success) {
        Message.success(response.data.msg)
      }
      resolve(response.data)
    }).catch(function (error) {
      reject(error)
    })
  })
};
