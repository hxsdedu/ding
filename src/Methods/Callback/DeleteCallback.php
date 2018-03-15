<?php
/**
 * Created by PhpStorm.
 * User: xiewh
 * Date: 2018/3/15
 * Time: 下午2:44
 */

namespace HXSD\Ding\Methods\Callback;


use HXSD\Ding\Constant\Request;
use HXSD\Ding\Methods\Callback\Base\BaseCallback;

class DeleteCallback extends BaseCallback
{
    public function execute(array $params)
    {
        return $this->curlQuery(function () use ($params) {
            return $this->curl->get($this->getUrl(Request::PATH_CALLBACK['delete_callback']),$params);
        });
    }
}