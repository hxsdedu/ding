<?php
/**
 * Created by PhpStorm.
 * User: xiewh
 * Date: 2018/3/8
 * Time: 上午10:46
 */

namespace HXSD\Ding\Facades;


use Illuminate\Support\Facades\Facade;

class Ding extends Facade
{
    /**
     * 获取组件的注册名称。
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'ding';
    }
}