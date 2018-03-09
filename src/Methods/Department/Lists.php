<?php
/**
 * Created by PhpStorm.
 * User: xiewh
 * Date: 2018/3/9
 * Time: 下午2:12
 */

namespace HXSD\Ding\Methods\Department;


use HXSD\Ding\Constant\Request;
use HXSD\Ding\Constant\ResponseParams;
use HXSD\Ding\Foundation\BaseMethod;

class Lists extends BaseMethod
{
    public function execute(array $params)
    {
        return $this->getDepartmentIds($params);
    }

    /**
     * 获取部门列表
     *
     * @param array $params
     * @return mixed
     * @throws \Exception
     */
    private function getDepartmentIds(array $params)
    {
        return $this->curlQuery(function () use ($params) {
            return $this->curl->get($this->getUrl(Request::PATH_DEPARTMENT['list']), $params);
        }, ResponseParams::DEPARTMENT['get_department_list']);
    }
}