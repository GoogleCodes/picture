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
      url: get_api.get_http_ip.GET_YUYIN_HTTP + 'public' + target,
      method: 'get',
      withCredentials: false
    }).then(function (response) {
      if (response.data.code == 0) {
        Message.warning(response.data.msg)
      } else if (response.data.code == 1) {
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
      url: get_api.get_http_ip.GET_YUYIN_HTTP + 'public' + target,
      method: 'post',
      data: postData,
      withCredentials: false
    }).then(function (response) {
      if (response.data.code == 0) {
        Message.warning(response.data.msg)
      } else if (response.data.code == 1) {
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
      url: get_api.get_http_ip.GET_YUYIN_HTTP + 'public' + target,
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
      url: get_api.get_http_ip.GET_YUYIN_HTTP + 'public' + target,
      method: 'delete',
      withCredentials: false
    }).then(function (response) {
      if (response.data.code == 0) {
        Message.warning(response.data.msg)
      } else if (response.data.code == 1) {
        Message.success(response.data.msg)
      }
      resolve(response.data)
    }).catch(function (error) {
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
