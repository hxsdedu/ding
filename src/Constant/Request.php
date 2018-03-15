<?php
/**
 * Created by PhpStorm.
 * User: xiewh
 * Date: 2018/3/8
 * Time: 下午3:23
 */

namespace HXSD\Ding\Constant;


class Request
{
    // 请求 http header
    const HTTP_HEADERS = [
        // curl 请求参数为 json
        'content-type' => 'application/json',
    ];

    // 钉钉 Restful API Url
    const API_URL = 'https://oapi.dingtalk.com/';

    // 验证相关请求路径
    const PATH_AUTH = [
        // 何获取Access_Token
        'get_token' => 'gettoken',
    ];

    // 钉钉部门相关请求路径
    const PATH_DEPARTMENT = [
        // 获取部门ID
        'ids' => 'department/list_ids',

        // 获取部门列表
        'list' => 'department/list',

        // 获取部门详情
        'info' => 'department/get',

        // 创建部门
        'create' => 'department/create',

        // 更新部门
        'update' => 'department/update',

        // 删除部门
        'delete' => 'department/delete',

        // 查询部门的所有上级父部门路径
        'all_parent' => 'department/list_parent_depts_by_dept',
    ];

    // 钉钉用户相关请求路径
    const PATH_USERS = [
        'simple_list' => 'user/simplelist',
        'details_list' => 'user/list'
    ];

    const PATH_CALLBACK = [
        'get_callback' => 'call_back/get_call_back',
        'register_callback' => 'call_back/register_call_back',
        'update_callback' => 'call_back/update_call_back',
        'delete_callback' => 'call_back/delete_call_back',
        'get_callback_failed_result' => 'call_back/get_call_back_failed_result',
    ];
}