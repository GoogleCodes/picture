<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2017 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Dean <zxxjjforever@163.com>
// +----------------------------------------------------------------------

return [
    // +----------------------------------------------------------------------
    // | 应用设置
    // +----------------------------------------------------------------------

    // 应用命名空间
    'app_namespace'          => 'api',
    // 应用模式状态
    'app_status'             => APP_DEBUG ? 'debug' : 'release',
    // 是否支持多模块
    'app_multi_module'       => true,
    // 入口自动绑定模块
    'auto_bind_module'       => false,
    // 注册的根命名空间
    'root_namespace'         => ['cmf' => CMF_PATH, 'plugins' => PLUGINS_PATH, 'app' => CMF_PATH . 'app/'],
    // 扩展函数文件
    'extra_file_list'        => [THINK_PATH . 'helper' . EXT, CMF_PATH . 'common' . EXT],
    // 默认输出类型
    'default_return_type'    => 'json',
    // 默认AJAX 数据返回格式,可选json xml ...
    'default_ajax_return'    => 'json',
    // 默认JSONP格式返回的处理方法
    'default_jsonp_handler'  => 'jsonpReturn',
    // 默认JSONP处理方法
    'var_jsonp_handler'      => 'callback',
    // 默认时区
    'default_timezone'       => 'PRC',
    // 是否开启多语言
    'lang_switch_on'         => false,
    // 默认全局过滤方法 用逗号分隔多个
    'default_filter'         => 'htmlspecialchars',
    // 默认语言
    'default_lang'           => 'zh-cn',
    // 应用类库后缀
    'class_suffix'           => true,
    // 控制器类后缀
    'controller_suffix'      => true,

    // +----------------------------------------------------------------------
    // | 模块设置
    // +----------------------------------------------------------------------

    // 默认模块名
    'default_module'         => 'home',
    // 禁止访问模块
    'deny_module_list'       => ['common'],
    // 默认控制器名
    'default_controller'     => 'Index',
    // 默认操作名
    'default_action'         => 'index',
    // 默认验证器
    'default_validate'       => '',
    // 默认的空控制器名
    'empty_controller'       => 'Error',
    // 自动搜索控制器
    'controller_auto_search' => false,

    // +----------------------------------------------------------------------
    // | URL设置
    // +----------------------------------------------------------------------

    'pathinfo_depr'        => '/',
    // URL伪静态后缀
    'url_html_suffix'      => 'html',
    // URL普通方式参数 用于自动生成
    'url_common_param'     => false,
    // URL参数方式 0 按名称成对解析 1 按顺序解析
    'url_param_type'       => 0,
    // 是否开启路由
    'url_route_on'         => true,
    // 路由配置文件（支持配置多个）
    'route_config_file'    => ['route'],
    // 是否强制使用路由
    'url_route_must'       => false,
    // 域名部署
    'url_domain_deploy'    => false,
    // 域名根，如thinkphp.cn
    'url_domain_root'      => '',
    // 是否自动转换URL中的控制器和操作名
    'url_convert'          => true,
    // 默认的访问控制器层
    'url_controller_layer' => 'controller',
    // 表单请求类型伪装变量
    'var_method'           => '_method',

    // +----------------------------------------------------------------------
    // | 模板设置
    // +----------------------------------------------------------------------

    'template'              => [
        // 模板引擎类型 支持 php think 支持扩展
        'type'         => 'Think',
        // 视图根目录
        'view_base'    => '',
        // 模板路径
        'view_path'    => '',
        // 模板后缀
        'view_suffix'  => 'html',
        // 模板文件名分隔符
        'view_depr'    => DS,
        // 模板引擎普通标签开始标记
        'tpl_begin'    => '{',
        // 模板引擎普通标签结束标记
        'tpl_end'      => '}',
        // 标签库标签开始标记
        'taglib_begin' => '<',
        // 标签库标签结束标记
        'taglib_end'   => '>',
    ],

    // 视图输出字符串内容替换
    'view_replace_str'      => [],
    // 默认跳转页面对应的模板文件
    'dispatch_success_tmpl' => THINK_PATH . 'tpl' . DS . 'dispatch_jump.tpl',
    'dispatch_error_tmpl'   => THINK_PATH . 'tpl' . DS . 'dispatch_jump.tpl',

    // +----------------------------------------------------------------------
    // | 异常及错误设置
    // +----------------------------------------------------------------------

    // 异常页面的模板文件
    'exception_tmpl'        => THINK_PATH . 'tpl' . DS . 'think_exception.tpl',

    // 错误显示信息,非调试模式有效
    'error_message'         => '页面错误！请稍后再试～',
    // 显示错误信息
    'show_error_msg'        => false,
    // 异常处理handle类 留空使用 \think\exception\Handle
    'exception_handle'      => '',

    // +----------------------------------------------------------------------
    // | 日志设置
    // +----------------------------------------------------------------------

    'log'   => [
        // 日志记录方式，内置 file socket 支持扩展
        'type'  => 'File',
        // 日志保存目录
        'path'  => LOG_PATH,
        // 日志记录级别
        'level' => [],
    ],

    // +----------------------------------------------------------------------
    // | Trace设置 开启 app_trace 后 有效
    // +----------------------------------------------------------------------
    'trace' => [
        // 内置Html Console 支持扩展
        'type' => 'Html',
    ],

    // +----------------------------------------------------------------------
    // | 缓存设置
    // +----------------------------------------------------------------------

    'cache' => [
        // 驱动方式
        'type'   => 'File',
        // 缓存保存目录
        'path'   => CACHE_PATH,
        // 缓存前缀
        'prefix' => '',
        // 缓存有效期 0表示永久缓存
        'expire' => 0,
    ],

    // +----------------------------------------------------------------------
    // | 会话设置
    // +----------------------------------------------------------------------

    'session' => [
        'id'             => '',
        // SESSION_ID的提交变量,解决flash上传跨域
        'var_session_id' => '',
        // SESSION 前缀
        'prefix'         => 'think',
        // 驱动方式 支持redis memcache memcached
        'type'           => '',
        // 是否自动开启 SESSION
        'auto_start'     => true,
    ],

    // +----------------------------------------------------------------------
    // | Cookie设置
    // +----------------------------------------------------------------------
    'cookie'  => [
        // cookie 名称前缀
        'prefix'    => '',
        // cookie 保存时间
        'expire'    => 0,
        // cookie 保存路径
        'path'      => '/',
        // cookie 有效域名
        'domain'    => '',
        //  cookie 启用安全传输
        'secure'    => false,
        // httponly设置
        'httponly'  => '',
        // 是否使用 setcookie
        'setcookie' => true,
    ],

    // +----------------------------------------------------------------------
    // | 数据库设置
    // +----------------------------------------------------------------------

    'database'                => [
        // 数据库调试模式
        'debug'           => true,
        // 数据集返回类型
        'resultset_type'  => '\think\Collection',
        // 自动写入时间戳字段
        'auto_timestamp'  => false,
        // 时间字段取出后的默认时间格式
        'datetime_format' => false,
        // 是否需要进行SQL性能分析
        'sql_explain'     => false,
    ],

    //分页配置
    'paginate'                => [
        'type'      => 'bootstrap',
        'var_page'  => 'page',
        'list_rows' => 15,
    ],
    //图片验证码
    'captcha'                 => [
        // 验证码字符集合
        'codeSet'  => '2345678abcdefhijkmnpqrstuvwxyzABCDEFGHJKLMNPQRTUVWXY',
        // 验证码字体大小(px)
        'fontSize' => 25,
        // 是否画混淆曲线
        'useCurve' => true,
        // 验证码图片高度
        'imageH'   => 30,
        // 验证码图片宽度
        'imageW'   => 100,
        // 验证码位数
        'length'   => 5,
        // 验证成功后是否重置
        'reset'    => true
    ],

    // +----------------------------------------------------------------------
    // | CMF 设置
    // +----------------------------------------------------------------------
    'cmf_theme_path'          => 'themes/home/',
    'cmf_default_theme'       => 'simpleboot3',
    'cmf_admin_theme_path'    => 'themes/admin/',
    'cmf_admin_default_theme' => 'simpleboot3',


    //云片网配置
    'yunpian_config'        => [
        'apikey'            => '84da7a10c94c2c97f2a6d83057be94f5',
        'url_single'        => 'https://sms.yunpian.com/v2/sms/single_send.json'
    ],

    //支付宝配置
    'alipay'        => [
        'app_id'                => '2017111609968817',
        'merchant_private_key'  => 'MIIEpQIBAAKCAQEA2QAKbHSbkj2H/HQT717oXARsKXxLjCgDXWLQqQORUM/mtXX3S1nj6tx/P+A9yMEMD52RAjYlMeXkxVn4jOepkPpyDTbpN+qhcTJybcsQCxRedQxeyPc7pPlMpPAMLFI7fV0jooocUmYOy26dkHO6MHyQwsew24hIuNUPkCy7/MTbEwzNhgOX6hjuUrHCtWCZRx2dI4Uo+ZE+ZwgJAF+aP/zWzELODgfXOOpcLPpaS37Ie0bMYhytaDp2FUmDYYFhKIfgTEkFgjbXOvqY7d1rPOKYnVNn755Dhhk1HI0+zBKcmnUEbKJfjJaTppwil+XAcR6AGGW26PLVcp/eOAnAjQIDAQABAoIBAAKW24j7wzd1gH/kqrA6g69FZj0AfK5Jc/DTUwYRQtSiBnC33aGKiwusYeBTPql8lDZDfQ13s+3qflZUgoC76uwN8PpzY0kFhbOiFHd26tQXBCGFakQfnxiS2PVG3/5PZOJUEC7KUxgwm5CV209z8g7ODbQlSdj0wVljQXJI9l1HvmxwaPqn9m6X5axCEKAdVnetmBmLSjcIv2fy8ZGR1Eoy2rkafoj/1MabIGq/DLqzRlK1a8y8g+TqQBGpOiafNx0EG1pFlZic3door+rHkH4JAHtVyBbijn/3b+f8xQjBsjfqkxCu8nmkzlRLZcSWgSYQJvqPPAZvDJp0otfgs8ECgYEA9PiU/LJr4m7Xo7NMJchImrucWlq36mTRwaSdlOoNkGyk2dQv+0MG5kjpeSrs0kjhQAXtWS2gcQpyh9Dw5p/opW0KY0wusKHrByKNmNgPhnMR7Vyne2ft+ecQZP6yhBsrnFygEllShpbZ5C7uvJSV8Okesh2nQav/DnVTDQAn+mUCgYEA4sUUfKwAHBegy43OFK7oAiQJhIoltkpyvVmLWRM+cUOVOy6sJhwSCayZGrOo39N5MBM5M6T++cUuZsQ/y0qkmuuKdlRBqJ4ES4EBmXeHa8tKR5+Fe7KwfSx6H4cLf+uWzfQ+CTvmthDQ/azMzh64p2glcB6vNS7Z5zu/n/H5dwkCgYEAviDk+Y+9PfwLb6lsM3LULwvnmRUJ42kmh6WtDHPv3SUFeW8/YkMuarMySfGv5rHb6WXwRiOsf6+9Hn5jSovX8/TCeDkbj8nL8Ti3L2aZ/h73TgN4lcYfJLNavRgVE4VG/s/BCRy8eWtBZ+GpN0IXcehtA48STl0g02bp85AodyUCgYEAmxXVUP4AhTXTjeJJEfQcT3p919ryt5xqo/xdRGnYxnVF1dexe86ut1cGzjAYShrCQpKjCCLLDd5AQZ/tUQaXVCvJ4er1jG+k2E493crVHm9FOX5rN5GZCcIlMvKUdsOTuv5SftYsjk8p3pMS7dQszLB5ChiyElkcRPujras6xKECgYEAxhTi/IfPAcEijquqwTZ67c4BASyFDYKaSVn77rlVxxU2JM8PNryaalSlgcV+K7jPjJfOqE4zrr1rzbJpHnHUawq/pA59M9glDmdTet26BVNEjkrumefbW+i4lZCv/0UhHdIeB5xl2Q1fByp+VAvlFPPrydh2pGutBgIWkZK+g7w=',
        'notify_url'            => 'https://www.xinye-art.com/public/api/home/pay/alnotify',
        'return_url'            => 'https://www.xinye-art.com/public/api/home/pay/alret',
        'charset'               => 'UTF-8',
        'sign_type'             => 'RSA2',
        'gatewayUrl'            => 'https://openapi.alipay.com/gateway.do',
        'alipay_public_key'     => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAjsAvGEApf/XPhJ1GHQFtZI0MFrGRBoNycQa022TcAjBbDvWIpQGv1uni9obzLpMsN8N5tCWiXqzUL9QuMOk+4XLy0/QUTypeqmXflb6tA9cx9FDa9OSn2VNlkQpBXG3HMdhKR0WRN6sANqUgbVl84JPCigslGyLZifd8Lwm1lkhQSA5GOEu3XtfW1BBLVhKZn07FQBwUIRWtVLQYZqSyrxY/QHbCr3cD19ft/klW7/xr5VLuAivPIZo6HJytVbAW4ZoOJMUUiw63e4XSqXoJco+EyMCZAk8z/9gbZtKTLdiKwXnp0VvkhdjkpZBz2ZjC5/E9NADRYU6Agebly4E+OQIDAQAB',
    ],

    'easywechat'        => [
        // 前面的appid什么的也得保留哦
        'app_id' => 'wxb4835407f8bd7f6c',
        'secret' => 'e768753f61871111412b8a31b5827a60',
        // ...
        // payment
        'payment' => [
            'merchant_id'        => '1489874452',
            'key'                => '9596d74328a28edadc1069095885abc8',
            'cert_path'          => ROOT_PATH.'public/payfile/apiclient_cert.pem', // XXX: 绝对路径！！！！
            'key_path'           => ROOT_PATH.'public/payfile/apiclient_key.pem',      // XXX: 绝对路径！！！！
            'notify_url'         => 'http://yuyin.ittun.com/public/api/home/pay/wxnotify',       // 你也可以在下单时单独设置来想覆盖它
        ],
        'oauth' => [
            'scopes' => ['snsapi_userinfo'],
            'callback' => 'https://xinye-art.com/public/api/home/pay/getopenid',//微信登录 或者 openid
        ],
    ],

];
