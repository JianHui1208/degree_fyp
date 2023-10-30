<?php
return [
    'title' => "Laravel Project Modules",  //文档title
    'version'=>'1.0.0', //文档版本
    'copyright'=>'Powered By Laravel Project Modules', //版权信息
    'controller' => [
        'App\\Http\\Controllers\\Api\\V1\\Admin\\UsersApiController',
    ],
    'filter_method' => [
        //过滤 不解析的方法名称
        '_empty'
    ],
    'return_format' => [
        //数据格式
        // 'status' => "200/300/301/302",
        // 'message' => "提示信息",
        // 'data' => "{}", //默认返回值,当不存在参数时 返回的值，填字符串
    ],
    'public_header' => [
        //全局公共头部参数
        //如：['name'=>'version', 'require'=>1, 'default'=>'', 'desc'=>'版本号(全局)']
    ],
    'public_param' => [
        //全局公共请求参数，设置了所以的接口会自动增加次参数
        //如：['name'=>'token', 'type'=>'string', 'require'=>1, 'default'=>'', 'other'=>'' ,'desc'=>'验证（全局）')']
    ],
];