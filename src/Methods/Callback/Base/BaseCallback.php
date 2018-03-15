<?php
/**
 * Created by PhpStorm.
 * User: xiewh
 * Date: 2018/3/15
 * Time: 上午11:51
 */

namespace HXSD\Ding\Methods\Callback\Base;


use HXSD\Ding\Foundation\BaseMethod;

abstract class BaseCallback extends BaseMethod
{
    /**
     * 加解密需要用到的token
     *
     * @var string
     */
    protected $token;

    /**
     * 数据加密密钥。用于回调数据的加密，长度固定为43个字符
     *
     * @var string
     */
    protected $encodingAesKey;

    /**
     * 普通企业此参数为 corp_id
     *
     * @var string
     */
    protected $suiteKey;

    /**
     * 创建套件时检测回调地址有效性，使用 create_suite_key 作为 suite_key
     *
     * @var string
     */
    protected $createSuiteKey;

    /**
     * 加载配置参数
     */
    protected function initConfig()
    {
        $this->token = config('ding.callback.token');
        $this->encodingAesKey = config('ding.callback.aes_key');
        $this->suiteKey = empty(config('ding.callback.suite_key'))
            ? config('ding.auth_info.corp_id')
            : config('ding.callback.suite_key') ;
        $this->createSuiteKey = config('ding.callback.create_suite_key');
    }
}