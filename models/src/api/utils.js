/**
 * Created by SamHong on 2017/9/28.
 */

import axios from 'axios'
import qs from 'qs'
import { Message } from 'element-ui'
import getUri from '../common/port_uri'

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
      url: getUri.get_http_ip.HTTP_IP + 'public' + target,
      method: 'get',
      withCredentials: false
    }).then(function (response) {
      resolve(response.data)
      Message.success(response.data.msg);
    }).catch(function (error) {
      Message.warning(error)
      reject(error)
    })
  })
};

//  post
export const fetchPost = (target, data) => {
  return new Promise((resolve, reject) => {
    var postData = qs.stringify(data);
    axios({
      url: getUri.get_http_ip.HTTP_IP + 'public' + target,
      header: {
        'Access-Control-Allow-Origin' : '*',
        'Access-Control-Allow-Methods' : 'GET,POST,PATCH,PUT,OPTIONS',
        'Access-Control-Allow-Headers' : 'x-requested-with,content-type'
      },
      method: 'post',
      data: postData,
      withCredentials: false
    }).then(function (response) {
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
      url: getUri.get_http_ip.HTTP_IP + 'public' + target,
      header: {
        'Access-Control-Allow-Origin' : '*',
        'Access-Control-Allow-Methods' : 'GET,POST,PATCH,PUT,OPTIONS',
        'Access-Control-Allow-Headers' : 'x-requested-with,content-type'
      },
      method: 'put',
      data: postData,
      withCredentials: false
    }).then(function (response) {
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
      url: getUri.get_http_ip.HTTP_IP + 'public' + target,
      method: 'delete',
      withCredentials: false
    }).then(function (response) {
      resolve(response.data)
    }).catch(function (error) {
      Message.warning(error);
      reject(error)
    })
  })
};


//  json 序列化
export const storageSet = (key,value) => {
  try {
    value = JSON.stringify(value);
  } catch(e) {
    value = value;
  }
  window.localStorage.setItem(key,value);
};

export const storageGet = (key) => {
  if (!key) {
    throw new Error('没有找到key。');
    return
  }
  if (typeof key === 'object') {
    throw new Error('key不能是一个对象。');
  }
  if (key == null) {
    return {}
  }
  let key_Obj = null;
  try {
    key_Obj = JSON.parse(window.localStorage.getItem(key));
  } catch(e) {
    key = {};
  }
  return key_Obj;
};

export const storageRemove = (key) => {
  return window.localStorage.removeItem(key);
};
