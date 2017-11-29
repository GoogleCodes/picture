/**
 * Created by SamHong on 2017/9/28.
 */

import { Message } from 'element-ui'
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
