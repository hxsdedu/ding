<?php
/**
 * Created by PhpStorm.
 * User: xiewh
 * Date: 2018/3/14
 * Time: 上午9:57
 */

namespace HXSD\Ding\Constant;


class Event
{
    const CHECK_CREATE_SUITE_URL = 'check_create_suite_url';

    const EVENT_TYPE = [
        'check_url' => '\HXSD\Ding\Callback\Event\CheckUrl@index'
    ];


}