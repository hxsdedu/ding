<?php
/**
 * Created by PhpStorm.
 * User: xiewh
 * Date: 2018/3/13
 * Time: 下午3:13
 */

namespace HXSD\Ding\Methods\Callback\Crypto;


class DingtalkCrypt
{
    private $token;

    private $encodingAesKey;

    private $suiteKey;

    public function __construct(string $token, string $encodingAesKey, string $suiteKey)
    {
        $this->token = $token;
        $this->encodingAesKey = $encodingAesKey;
        $this->suiteKey = $suiteKey;
    }

    public function EncryptMsg($plain, &$encryptMsg, $timeStamp = null, $nonce = null)
    {
        $pc = new Prpcrypt($this->encodingAesKey);
        $array = $pc->encrypt($plain, $this->suiteKey);

        $ret = $array[0];
        if ($ret != 0) {
            return $ret;
        }
        if ($timeStamp == null) {
            $timeStamp = time();
        }
        $encrypt = $array[1];
        $sha1 = new SHA1;

        if ($nonce == null) {
            $nonce = str_random(6);
        }

        $array = $sha1->getSHA1($this->token, $timeStamp, $nonce, $encrypt);
        $ret = $array[0];
        if ($ret != 0) {
            return $ret;
        }
        $signature = $array[1];
        $encryptMsg = [
            "msg_signature" => $signature,
            "encrypt" => $encrypt,
            "timeStamp" => $timeStamp,
            "nonce" => $nonce
        ];
        return ErrorCode::$OK;
    }
    public function DecryptMsg($signature, $timeStamp = null, $nonce, $encrypt, &$decryptMsg)
    {
        if (strlen($this->encodingAesKey) != 43) {
            return ErrorCode::$IllegalAesKey;
        }
        $pc = new Prpcrypt($this->encodingAesKey);

        if ($timeStamp == null) {
            $timeStamp = time();
        }
        $sha1 = new SHA1;
        $array = $sha1->getSHA1($this->token, $timeStamp, $nonce, $encrypt);
        $ret = $array[0];
        if ($ret != 0) {
            return $ret;
        }
        $verifySignature = $array[1];

//        if ($verifySignature != $signature) {
//            return ErrorCode::$ValidateSignatureError;
//        }

        $result = $pc->decrypt($encrypt, $this->suiteKey);

        if ($result[0] != 0) {
            return $result[0];
        }
        $decryptMsg = $result[1];
        return ErrorCode::$OK;
    }
}