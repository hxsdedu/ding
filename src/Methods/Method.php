<?php
/**
 * Created by PhpStorm.
 * User: xiewh
 * Date: 2018/3/8
 * Time: 上午11:36
 */

namespace HXSD\Ding\Methods;


use HXSD\Ding\Constant\RequestParams;
use HXSD\Ding\Methods\Auth\AccessToken;
use HXSD\Ding\Methods\Department\ListIds;

trait Method
{
    /**
     * 获取钉钉 Access Token
     *
     * @param bool $isForce 是否强制请求 token
     * @return array
     */
    public function getAccessToken(bool $isForce = false)
    {
        return app(AccessToken::class)
            ->execute([
                RequestParams::AUTH['get_access_token'] => $isForce
            ]);
    }


    /**
     * 获取子部门ID列表
     * 父部门id(如果不传，默认部门为根部门，根部门ID为1
     *
     * @param int $parentId 父部门ID
     * @return array
     */
    public function getDepartmentIds(int $parentId = 1)
    {
        return app(ListIds::class)->execute([
            RequestParams::DEPARTMENT['get_department_ids'] => $parentId
        ]);
    }


}