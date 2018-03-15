<?php
/**
 * Created by PhpStorm.
 * User: xiewh
 * Date: 2018/3/15
 * Time: 下午1:56
 */

namespace HXSD\Ding\Methods\Callback;


use HXSD\Ding\Constant\Request;
use HXSD\Ding\Methods\Callback\Base\BaseCallback;

class EventCallback extends BaseCallback
{
    public function execute(array $params)
    {
        try {
            return $this->curlQuery(function () use ($params) {
                return $this->curl->get($this->getUrl(Request::PATH_CALLBACK['get_callback']),$params);
            });
        } catch (\Exception $exception) {
            preg_match('/\d{3,6}/', $exception->getMessage(), $matches);
            return [
                'errcode' => $matches[0],
                'errmsg' => $exception->getMessage()
            ];
        }
    }
}