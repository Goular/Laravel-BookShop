<?php
//用于overtrue/easy-sms短信引用的配置
//https://github.com/overtrue/easy-sms
return [
    // HTTP 请求的超时时间（秒）
    'timeout' => 2.0,
    // 默认发送配置
    'default' => [
        // 网关调用策略，默认：顺序调用
        'strategy' => \Overtrue\EasySms\Strategies\OrderStrategy::class,
        // 默认可用的发送网关
        'gateways' => [
            'yunpian'
        ],
    ],
    // 可用的网关配置
    'gateways' => [
        'errorlog' => [
            'file' => '/tmp/easy-sms.log',
        ],
        'yunpian' => [
            'api_key' => env('YUNPIAN_API_KEY',null),
        ],
    ]
];