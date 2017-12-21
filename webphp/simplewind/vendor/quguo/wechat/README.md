# quguo-wechat
趣果 微信常用的相关接口

curl: (60) SSL certificate problem: unable to get local issuer certificate

下载 CA 证书

你可以从 http://curl.haxx.se/ca/cacert.pem 下载 或者 使用微信官方提供的证书中的 CA 证书 rootca.pem 也是同样的效果。

在 php.ini 中配置 CA 证书

只需要将上面下载好的 CA 证书放置到您的服务器上某个位置，然后修改 php.ini 的 curl.cainfo 为该路径（绝对路径！），重启 php-fpm 服务即可。
~~~
curl.cainfo = /path/to/downloaded/cacert.pem
~~~

1.使用
1.1 配置easywechat config.php 
系统默认取 'easywechat'这个配置项
~~~
'easywechat' => [
      'debug' => true,
      'app_id' => 'wx7bb550009da91361',
      'secret' => '6c057a14918d2e7ac05b9902c9c4140e',
      'token' => 'qgshop2017',
      'log' => [
          'level' => 'debug',
          'file' => './easywechat-web.log'
      ],
      'payment' => [
          'merchant_id' => 1441995902,
          'key' => 'gdzhengshunxinnongyefazhangongsi',
      ],
      'oauth' => [
          'scopes' => ['snsapi_userinfo'],
          'callback' => 'http://caozhu.ittun.com/public/service/wechat/callback',//微信登录 或者 openid
      ],
      'paynotify_url'=>'http://wgc.quguonet.com/public/index/Wxpaynotify/payNotify',  //自己的回调地址
  ],
~~~
1.2 composer require quguo/wechat;
1.3 use Quguo\Wechat;
1.4 如需要单独配置 Wechat::setConfig($config);

