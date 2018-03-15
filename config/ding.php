<?php
/**
 * Created by PhpStorm.
 * User: xiewh
 * Date: 2018/3/8
 * Time: 上午11:50
 */

return [

    /**
     * 企业自用账号信息
     * 此信息在 【钉钉 -> 开放平台 -> 开发账号管理】 页面获取
     */
    'auth_info' => [
        // 企业接口调用
        'corp_id' => '',

        // 公司秘匙
        'corp_secret' => '',

        // 微应用管理后台
        'sso_secret' => '',

        // 服务窗应用
        'channel_secret' => '',
    ],

    /**
     * 钉钉事件回调配置
     */
    'callback' => [
        // 回调路径
        'route' => '',
        // 加解密需要用到的token，普通企业可以随机填写
        'token' => '',
        // 数据加密密钥。用于回调数据的加密，长度固定为43个字符
        'aes_key' => '',
        // 普通企业此参数为 corp_id
        'suite_key' => '',
        // 创建套件时检测回调地址有效性，使用 create_suite_key 作为 suite_key
        'create_suite_key' => '',
        // 事件操作
        'event' => [

        ],
    ],
];