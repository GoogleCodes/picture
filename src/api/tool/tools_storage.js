export default new class tools_storage {
  storageSet(key, values) {
    try {
      value = JSON.stringify(value);
    } catch(e) {
      value = value;
    }
    window.localStorage.setItem(key,value);
  }

  storageGet(key) {
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
  }

  storageRemove(key) {
    return window.localStorage.removeItem(key);
  }

  goJson(key) {
    return window.JSON.parse(key);
  }

}
