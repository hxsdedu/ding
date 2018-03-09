<?php
/**
 * Created by PhpStorm.
 * User: xiewh
 * Date: 2018/3/8
 * Time: 上午11:47
 */

namespace HXSD\Ding\Foundation;


use Curl\Curl;
use HXSD\Ding\Constant\Request;

class BaseDing
{
    /**
     * 企业ID
     *
     * @var string
     */
    protected $corpId;

    /**
     * 企业秘匙
     *
     * @var string
     */
    protected $corpSecret;

    /**
     * SSO 秘匙
     *
     * @var string
     */
    protected $ssoSecret;

    /**
     * Channe 秘匙
     *
     * @var string
     */
    protected $channelSecret;

    /**
     * @var
     */
    protected $curl;

    public function __construct()
    {
        // 程序初始化
        $this->applicationInit();
    }

    /**
     * 程序初始化方法
     *
     */
    private function applicationInit()
    {
        // 初初始化验证相关配置信息
        $this->initAuthConfig();

        // 实例化 Curl 类
        $this->initCurlClass();
    }

    /**
     * 初初始化验证相关配置信息
     *
     */
    private function initAuthConfig()
    {
        $this->corpId           = config('ding.auth_info.corp_id', null);
        $this->corpSecret       = config('ding.auth_info.corp_secret', null);
        $this->ssoSecret        = config('ding.auth_info.sso_secret', null);
        $this->channelSecret    = config('ding.auth_info.channel_secret', null);
    }

    /**
     * 实例化 curl 类
     *
     */
    private function initCurlClass()
    {
        $this->curl = $curl = new Curl();
        $this->curl->setHeaderS(Request::HTTP_HEADERS);
    }
}