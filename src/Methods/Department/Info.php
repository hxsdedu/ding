<?php
/**
 * Created by PhpStorm.
 * User: xiewh
 * Date: 2018/3/9
 * Time: 下午2:39
 */

namespace HXSD\Ding\Methods\Department;


use HXSD\Ding\Constant\Request;
use HXSD\Ding\Constant\ResponseParams;
use HXSD\Ding\Foundation\BaseMethod;

class Info extends BaseMethod
{
    public function execute(array $params)
    {
        return $this->getDepartmentInfo($params);
    }

    /**
     * 获取部门详情
     *
     * @param array $params
     * @return mixed
     * @throws \Exception
     */
    public function getDepartmentInfo(array $params)
    {
        return $this->curlQuery(function () use ($params) {
            return $this->curl->get($this->getUrl(Request::PATH_DEPARTMENT['info']), $params);
        }, ResponseParams::DEPARTMENT['get_department_info']);
    }
}