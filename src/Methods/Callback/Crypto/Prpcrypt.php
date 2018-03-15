<?php
/**
 * Created by PhpStorm.
 * User: xiewh
 * Date: 2018/3/13
 * Time: 下午3:26
 */

namespace HXSD\Ding\Methods\Callback\Crypto;


class Prpcrypt
{

    public $key;

    public function __construct(string $k)
    {
        $this->key = base64_decode($k . "=");
    }

    public function encrypt($text, $corpid)
    {
        try {
            //获得16位随机字符串，填充到明文之前
            $random = $this->getRandomStr();
            $text = $random . pack("N", strlen($text)) . $text . $corpid;
            $iv = substr($this->key, 0, 16);
            $pkc_encoder = new PKCS7Encoder;
            $text = $pkc_encoder->encode($text);

            $encrypted = base64_encode(openssl_encrypt($text, "aes-256-cbc", $this->key, OPENSSL_RAW_DATA|OPENSSL_ZERO_PADDING, $iv));
            return array(ErrorCode::$OK, $encrypted);
        } catch (\Exception $e) {
            print $e;
            return array(ErrorCode::$EncryptAESError, null);
        }
    }
    public function decrypt($encrypted, $corpid)
    {
        $ciphertext_dec = base64_decode($encrypted);
        $iv = substr($this->key, 0, 16);
        $decrypted = openssl_decrypt($ciphertext_dec, 'aes-256-cbc', $this->key, OPENSSL_RAW_DATA|OPENSSL_ZERO_PADDING, $iv);

        if ($decrypted === false) {
            return [ErrorCode::$DecryptAESError, null];
        }

        try {
            //去除补位字符
            $pkc_encoder = new PKCS7Encoder;
            $result = $pkc_encoder->decode($decrypted);
            //去除16位随机字符串,网络字节序和AppId
            if (strlen($result) < 16)
                return "";
            $content = substr($result, 16, strlen($result));
            $len_list = unpack("N", substr($content, 0, 4));
            $xml_len = $len_list[1];
            $xml_content = substr($content, 4, $xml_len);
            $from_corpid = substr($content, $xml_len + 4);
        } catch (\Exception $e) {
            print $e;
            return array(ErrorCode::$DecryptAESError, null);
        }
        if ($from_corpid != $corpid){
            return array(ErrorCode::$ValidateSuiteKeyError, null);
        }

        return array(0, $xml_content);
    }
    function getRandomStr()
    {
        $str = "";
        $str_pol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
        $max = strlen($str_pol) - 1;
        for ($i = 0; $i < 16; $i++) {
            $str .= $str_pol[mt_rand(0, $max)];
        }
        return $str;
    }

}