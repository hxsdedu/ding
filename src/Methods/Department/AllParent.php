<?php
/**
 * Created by PhpStorm.
 * User: xiewh
 * Date: 2018/3/9
 * Time: 下午4:08
 */

namespace HXSD\Ding\Methods\Department;


use HXSD\Ding\Constant\Request;
use HXSD\Ding\Constant\ResponseParams;
use HXSD\Ding\Foundation\BaseMethod;

class AllParent extends BaseMethod
{
    public function execute(array $params)
    {
        return $this->getAllParent($params);
    }

    /**
     * 查询部门的所有上级父部门路径
     *
     * @param array $params
     * @return array
     * @throws \Exception
     */
    private function getAllParent(array $params)
    {
        return $this->curlQuery(function () use ($params) {
            return $this->curl->get($this->getUrl(Request::PATH_DEPARTMENT['all_parent']),$params);
        }, ResponseParams::DEPARTMENT['get_all_parent_daepartment']);
    }
}