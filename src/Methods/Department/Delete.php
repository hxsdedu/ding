<?php
/**
 * Created by PhpStorm.
 * User: xiewh
 * Date: 2018/3/9
 * Time: 下午3:57
 */

namespace HXSD\Ding\Methods\Department;


use HXSD\Ding\Constant\Request;
use HXSD\Ding\Foundation\BaseMethod;

class Delete extends BaseMethod
{
    public function execute(array $params)
    {
        return $this->deleteDepartment($params);
    }

    /**
     * @param array $params
     * @return array
     * @throws \Exception
     */
    private function deleteDepartment(array $params)
    {
        return $this->curlQuery(function () use ($params) {
            return $this->curl->get($this->getUrl(Request::PATH_DEPARTMENT['delete']),$params);
        });
    }
}