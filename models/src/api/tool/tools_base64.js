// //base64加密解密工具

//存储前缀
import {base64_prefix} from '../../common/config'

import base64 from 'js-base64'

export default new class Base64 {
  constructor() {
    this.prefix = base64_prefix
    this.base64 = base64.Base64
  }

  //base64加密
  encode(val) {
    return this.base64.encode(base64_prefix + val)
  }

  //base解密
  decode(val) {
    return this.base64.decode(base64_prefix + val)
  }
}
