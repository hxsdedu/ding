<?php
/**
 * Created by PhpStorm.
 * User: xiewh
 * Date: 2018/3/15
 * Time: 下午3:15
 */

namespace HXSD\Ding\Methods\Callback;


use HXSD\Ding\Constant\Request;
use HXSD\Ding\Methods\Callback\Base\BaseCallback;

class CallbackFailedResult extends BaseCallback
{
    public function execute(array $params)
    {
        return $this->curlQuery(function () use ($params) {
            return $this->curl->get($this->getUrl(Request::PATH_CALLBACK['get_callback_failed_result']),$params);
        });
    }
}