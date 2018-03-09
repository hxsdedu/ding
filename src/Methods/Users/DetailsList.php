<?php
/**
 * Created by PhpStorm.
 * User: xiewh
 * Date: 2018/3/9
 * Time: 下午5:12
 */

namespace HXSD\Ding\Methods\Users;


use HXSD\Ding\Constant\Request;
use HXSD\Ding\Constant\ResponseParams;
use HXSD\Ding\Foundation\BaseMethod;

class DetailsList extends BaseMethod
{
    public function execute(array $params)
    {
        return $this->getUserSimpleList($params);
    }

    /**
     * 获取部门成员
     *
     * @param array $params
     * @return array
     * @throws \Exception
     */
    public function getUserSimpleList(array $params)
    {
        return $this->curlQuery(function () use ($params) {
            return $this->curl->get($this->getUrl(Request::PATH_USERS['details_list']),$params);
        });
    }
}