<?php
/**
 * Created by PhpStorm.
 * User: xiewh
 * Date: 2018/3/13
 * Time: 下午3:29
 */

namespace HXSD\Ding\Callback\Crypto;


class PKCS7Encoder
{
    public static $block_size = 32;

    function encode($text)
    {
        $block_size = PKCS7Encoder::$block_size;
        $text_length = strlen($text);
        $amount_to_pad = PKCS7Encoder::$block_size - ($text_length % PKCS7Encoder::$block_size);
        if ($amount_to_pad == 0) {
            $amount_to_pad = PKCS7Encoder::block_size;
        }
        $pad_chr = chr($amount_to_pad);
        $tmp = "";
        for ($index = 0; $index < $amount_to_pad; $index++) {
            $tmp .= $pad_chr;
        }
        return $text . $tmp;
    }
    function decode($text)
    {
        $pad = ord(substr($text, -1));
        if ($pad < 1 || $pad > PKCS7Encoder::$block_size) {
            $pad = 0;
        }
        return substr($text, 0, (strlen($text) - $pad));
    }
}