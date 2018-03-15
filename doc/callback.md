# 回调相关

## 配置信息
```php
/**
 * 钉钉事件回调配置
 */
'callback' => [
    // 回调路径
    'route' => 'callback',
    // 加解密需要用到的token，普通企业可以随机填写
    'token' => 'aaaaaa',
    // 数据加密密钥。用于回调数据的加密，长度固定为43个字符
    'aes_key' => 'bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb',
    // 普通企业此参数为 corp_id
    'suite_key' => '',
    // 创建套件时检测回调地址有效性，使用 create_suite_key 作为 suite_key
    'create_suite_key' => '',
    // 事件操作
    'event' => [
        // 钉钉 org_dept_create 事件回调时将调用 TestServer 类的 index 方法
        // 使用 laravel 框架 Request::all() 等方式可以获取到回调参数
        'org_dept_create' => 'App/Service/TestServer@index',
        'user_modify_org' => 'App/Service/TestServer@user',
    ],
],
```

## 根据配置创建回调和更新回调

#### array Ding::registerCallback()

- 参数说明

    参数 |	参数类型 |	必须 |	说明
    --- | --- | --- | ---
    无 | | |
    
- 返回结果
    ```php
      [
        "errcode" => 0 // 返回码
        "errmsg" => "ok" 
      ]
    ```
    
## 获取配置回调设置信息

#### array Ding::getCallback()
- 参数说明

    参数 |	参数类型 |	必须 |	说明
    --- | --- | --- | ---
    无 | | |
    
- 返回结果
    ```php
    [
        "errcode" => 0
        "call_back_tag" =>
            0 => "org_dept_create"
            1 => "user_modify_org"
        ]
        "aes_key" => "bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb"
        "errmsg" => "ok"
        "url" => "http://xx.xx.xx/callback"
        "token" => "aaaaaa"
    ]
    ```
    
## 删除回调

#### array Ding::deleteCallback()
- 参数说明

    参数 |	参数类型 |	必须 |	说明
    --- | --- | --- | ---
    无 | | |
    
- 返回结果
    ```php
    [
        "errcode" => 0
        "errmsg" => "ok"
    ]
    ```
    
## 获取回调失败信息
#### array Ding::getCallbackFailedResult()

- 参数说明

    参数 |	参数类型 |	必须 |	说明
    --- | --- | --- | ---
    无 | | |
    

```php
[
    "errcode" => 0
    "hasMore" => false
    "errmsg" => "ok"
    "failed_list" => []
]
```

