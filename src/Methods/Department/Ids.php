<?php
/**
 * Created by PhpStorm.
 * User: xiewh
 * Date: 2018/3/8
 * Time: 下午3:58
 */

namespace HXSD\Ding\Methods\Department;


use HXSD\Ding\Constant\Request;
use HXSD\Ding\Constant\RequestParams;
use HXSD\Ding\Constant\ResponseParams;
use HXSD\Ding\Foundation\BaseMethod;

class Ids extends BaseMethod
{
    public function execute(array $params)
    {
        return $this->getDepartmentIds($params[RequestParams::DEPARTMENT['get_department_ids']]);
    }

    /**
     * 获取子部门 ID 列表
     *
     * @param int $parentId
     * @return array
     * @throws \Exception
     */
    private function getDepartmentIds(int $parentId)
    {
        return $this->curlQuery(function () use ($parentId) {
            return $this->curl->get($this->getUrl(Request::PATH_DEPARTMENT['ids']), array(
                'id' => $parentId
            ));
        }, ResponseParams::DEPARTMENT['get_department_ids']);
    }
}