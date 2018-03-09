<?php
/**
 * Created by PhpStorm.
 * User: xiewh
 * Date: 2018/3/8
 * Time: 下午4:01
 */

namespace HXSD\Ding\Constant;


class RequestParams
{
    const AUTH = [
        'get_access_token' => 'is_force',
    ];

    const DEPARTMENT = [
        'get_department_ids' => 'parent_id',

        'get_department_list' => [
            'parent_id' => 'id',
            'fetch_child' => 'fetch_child',
            'lang' => 'lang',
        ],

        'get_department_info' => [
            'id' => 'id',
            'lang' => 'lang',
        ],

        'create_department' => [
            'name' => 'name',
            'parent_id' => 'parentid',
            'order' => 'order',
            'create_dept_group' => 'createDeptGroup',
            'dept_hiding' => 'deptHiding',
            'dept_perimits' => 'deptPerimits',
            'user_perimits' => 'userPerimits',
            'outer_dept' => 'outerDept',
            'outer_permit_depts' => 'outerPermitDepts',
            'outer_permit_users' => 'outerPermitUsers',
            'source_identifier' => 'sourceIdentifier'
        ],

        'update_department' => [
            'name' => 'name',
            'id' => 'id',
            'order' => 'order',
            'create_dept_group' => 'createDeptGroup',
            'dept_hiding' => 'deptHiding',
            'dept_perimits' => 'deptPerimits',
            'user_perimits' => 'userPerimits',
            'outer_dept' => 'outerDept',
            'outer_permit_depts' => 'outerPermitDepts',
            'outer_permit_users' => 'outerPermitUsers',
            'source_identifier' => 'sourceIdentifier'
        ],

        'delete_department' => 'id',

        'get_all_parent_daepartment' => 'id'
    ];
}