<?php
/**
 * Created by PhpStorm.
 * User: xiewh
 * Date: 2018/3/8
 * Time: 上午11:38
 */

namespace HXSD\Ding\Methods\Auth;


use Illuminate\Support\Facades\Cache;
use HXSD\Ding\Constant\Request;
use HXSD\Ding\Constant\RequestParams;
use HXSD\Ding\Constant\ResponseParams;
use HXSD\Ding\Foundation\BaseMethod;
use HXSD\Ding\Constant\Cache as CacheConstant;

class AccessToken extends BaseMethod
{
    /**
     * 获取钉钉 Access Token
     *
     * @param array $params['is_force'] 是否强制请求 token
     * @return array
     */
    public function execute(array $params)
    {
        // 判断是否强制请求 access token
        if ($params[RequestParams::AUTH['get_access_token']]) {
            // 请除缓存 access token
            Cache::forget(CacheConstant::ACCESS_TOKEN['cache_key']);
        }

        // 获取 access token 并缓存
        return Cache::remember(CacheConstant::ACCESS_TOKEN['cache_key'],
            CacheConstant::ACCESS_TOKEN['cache_time'], function () {
                return $this->getAccessToken();
        });
    }

    /**
     * 获取钉钉 access token
     *
     * @return array
     * @throws \Exception
     */
    private function getAccessToken()
    {
        return $this->curlQuery(function () {
            return $this->curl->get(
                $this->getUrl(Request::PATH_AUTH['get_token'], Request::API_URL, false), [
                'corpid' => $this->corpId,
                'corpsecret' => $this->corpSecret,
            ]);
        }, ResponseParams::AUTH['get_access_token']);
    }
}