<?php
/**
 * Created by PhpStorm.
 * User: xiewh
 * Date: 2018/3/8
 * Time: 上午11:42
 */

namespace HXSD\Ding\Foundation;


use HXSD\Ding\Constant\Request;
use HXSD\Ding\Facades\Ding;

abstract class BaseMethod extends BaseDing
{
    /**
     * 执行操作方法
     *
     * @param array $params
     * @return mixed
     */
    abstract public function execute(array $params);

    protected function curlQuery(\Closure $callback, string $responseKey = null)
    {
        if (($response = $callback())->errcode != 0) {
            throw new \Exception(
                '钉钉 Api 接口请求异常，error_code: '
                . $response->errcode .' error_msg: '
                .$response->errmsg
            );
        }

        if (is_null($responseKey) === false) {
            $response = $response->$responseKey;
        }

        if (is_string($response) === false) {
            $response = (array)$response;
        }

        return $response;
    }

    /**
     * 获取钉钉全路径 API 接口 url
     *
     * @param string $path api 接口路径
     * @param string $url api 接口url
     * @return string 完整的 api接口 URL
     */
    protected function getUrl(string $path, $url = Request::API_URL, bool $isAddToken = true)
    {
        $url = rtrim($url, '/') . '/' . $path;
        if ($isAddToken) {
            $url .= '?access_token='.Ding::getAccessToken();
        }
        return $url;
    }


}