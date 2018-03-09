<?php
/**
 * Created by PhpStorm.
 * User: xiewh
 * Date: 2018/3/8
 * Time: 下午5:46
 */

namespace HXSD\Ding\Constant;


class ResponseParams
{

    const AUTH = [
        'get_access_token' => 'access_token',
    ];

    const DEPARTMENT = [
        'get_department_ids' => 'sub_dept_id_list',
        'get_department_list' => 'department',
        'get_department_info' => null,
        'get_all_parent_daepartment' => 'parentIds',
    ];

    const USERS = [
        'get_user_simple_list' => 'userlist',
    ];
}