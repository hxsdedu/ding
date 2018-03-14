<?php
/**
 * Created by PhpStorm.
 * User: xiewh
 * Date: 2018/3/13
 * Time: 下午3:30
 */

namespace HXSD\Ding\Callback\Crypto;


class SHA1
{
    public function getSHA1($token, $timestamp, $nonce, $encrypt_msg)
    {
        try {
            $array = array($encrypt_msg, $token, $timestamp, $nonce);
            sort($array, SORT_STRING);
            $str = implode($array);
            return array(ErrorCode::$OK, sha1($str));
        } catch (\Exception $e) {
            print $e . "\n";
            return array(ErrorCode::$ComputeSignatureError, null);
        }
    }
}