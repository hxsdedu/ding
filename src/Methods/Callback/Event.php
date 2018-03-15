<?php
/**
 * Created by PhpStorm.
 * User: xiewh
 * Date: 2018/3/13
 * Time: 下午5:12
 */

namespace HXSD\Ding\Methods\Callback;


use HXSD\Ding\Methods\Callback\Base\BaseCallback;
use HXSD\Ding\Methods\Callback\Crypto\DingtalkCrypt;
use HXSD\Ding\Methods\Callback\Crypto\ErrorCode;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use HXSD\Ding\Constant\Event as EventType;

class Event extends BaseCallback
{
    /**
     * 请求参数
     *
     * @var array
     */
    protected $requestParms;

    protected $eventTypes;

    protected $request;

    protected $crypt;

    /**
     * Event constructor.
     */
    public function __construct()
    {
        parent::initConfig();

        // 实例化加解密类
        $this->instanceDingtalkCrypt($this->suiteKey);

        // 加载事件回调类型
        $this->initEventTypes();

        // 解密消息体
        $this->decryptRequest();
    }

    /**
     * 钉钉回调入口方法
     *
     * @return array
     * @throws \Exception
     */
    public function execute(array $params)
    {
        $decrypt = Request::get('decrypt', []);
        if (isset($decrypt['EventType']) === false) {
            // 正常不会出现
            throw new \Exception('unknown error');
        }
        // 方法名
        $method = $this->eventTypes[$decrypt['EventType']]['method'];

        // 执行调用
        $responseInfo = app($this->eventTypes[$decrypt['EventType']]['class'])->$method();

        $encryptMsg = [];
        $this->crypt->EncryptMsg($responseInfo, $encryptMsg);

        return $encryptMsg;
    }

    /**
     * 获取请求参数
     */
    protected function decryptRequest()
    {
        // 解密回调消息体
        $temp = $this->decrypt();

        // 判断消息体是否解密成功
        if ($temp['code'] != ErrorCode::$OK) {

            // 不成功 使用 创建套件时检测回调地址有效性
            $this->instanceDingtalkCrypt($this->createSuiteKey);
            $temp = $this->decrypt();

            // 判断消息体是否解密成功
            if ($temp['code'] != ErrorCode::$OK) {
                // 不成功，记录日志，抛出异常
                Log::error('ding callback failure ErrorCode: ' . $temp['code'] . 'Request: ' . json_encode(Request::all()));
                throw new \Exception('ding callback failure ErrorCode: ' . $temp['code']);
            }
        }

        // 解密后的消息重新赋值
        Request::offsetSet('decrypt', json_decode($temp['decrypt'], true));
    }

    /**
     * 解密执行方法
     *
     * @return array
     */
    protected function decrypt()
    {

        $decrypt = '';

        $errCode = $this->crypt->DecryptMsg(
            Request::get('signature'), Request::get('timestamp'),
            Request::get('nonce'), Request::get('encrypt'), $decrypt
        );

        return [
            'code' => $errCode,
            'decrypt' => $decrypt
        ];
    }

    /**
     * 初使化事件配置
     *
     * @throws \Exception
     */
    protected function initEventTypes()
    {
        $sysEvent = EventType::EVENT_TYPE;
        foreach ($sysEvent as $key => $value) {
            $this->eventTypes[$key] = $this->analysisEventConfig($value);
        }

        $event = config('ding.callback.event');
        foreach ($event as $key => $value) {
            $this->eventTypes[$key] = $this->analysisEventConfig($value);
        }
    }

    /**
     * 解析事件回调配置文件
     *
     * @param string $event
     * @return array
     * @throws \Exception
     */
    protected function analysisEventConfig(string $event)
    {
        try {
            $event = explode('@', $event);
            return [
                'class' => $event[0],
                'method' => $event[1]
            ];
        } catch (\Exception $exception) {
            throw new \Exception('callback configuration error');
        }
    }

    /**
     * 实例化加解密类
     *
     * @param string $suiteKey
     */
    protected function instanceDingtalkCrypt(string $suiteKey)
    {
        $this->crypt =  app(DingtalkCrypt::class, [
            'token' => $this->token, 'encodingAesKey' => $this->encodingAesKey, 'suiteKey' => $suiteKey
        ]);
    }


}