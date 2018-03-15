<?php
/**
 * Created by PhpStorm.
 * User: xiewh
 * Date: 2018/3/15
 * Time: 下午1:40
 */

namespace HXSD\Ding\Methods\Callback;


use HXSD\Ding\Constant\Request;
use HXSD\Ding\Facades\Ding;
use HXSD\Ding\Methods\Callback\Base\BaseCallback;

class RegisterCallback extends BaseCallback
{
    public function execute(array $params)
    {
        parent::initConfig();

        $callback = Ding::getCallback();

        if ($callback['errcode'] == '71007' ) {
            return $this->curlQuery(function () {
                return $this->curl->post($this->getUrl(Request::PATH_CALLBACK['register_callback']),
                    $this->getCallbackParams());
            });
        } else {
            return $this->curlQuery(function () {
                return $this->curl->post($this->getUrl(Request::PATH_CALLBACK['update_callback']),
                    $this->getCallbackParams());
            });
        }
    }

    protected function getCallbackParams()
    {
        return [
            'call_back_tag' => array_keys(config('ding.callback.event')),
            'token' => $this->token,
            'aes_key' => $this->encodingAesKey,
            'url' => route('ding_callback'),
        ];
    }
}