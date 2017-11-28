/**
 * Created by SamHong on 2017/11/28.
 */

import { tools_filter } from './index'

const uri = "https://www.xinye-art.com/mobile/index.html";

export default new class tools_mobile {



  //  判断是否iphone 手机
  goSwitch() {
    switch(true) {
      case tools_filter.os().isPhone:
        window.location.href = uri;
        break;
      case tools_filter.os().isAndroid:
        window.location.href = uri;
        break;
      default:
        break;
    }
  }
}
