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
use HXSD\Ding\Methods\Department\AllParent;
use HXSD\Ding\Methods\Department\Create;
use HXSD\Ding\Methods\Department\Delete;
use HXSD\Ding\Methods\Department\Ids;
use HXSD\Ding\Methods\Department\Info;
use HXSD\Ding\Methods\Department\Lists;
use HXSD\Ding\Methods\Department\Update;
use HXSD\Ding\Methods\Users\DetailsList;
use HXSD\Ding\Methods\Users\SimpleList;

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
        return app(Ids::class)->execute([
            RequestParams::DEPARTMENT['get_department_ids'] => $parentId
        ]);
    }

    /**
     * 获取部门列表
     *
     * @param int $parentId 父部门id
     * @param bool $isFetchChild 是否递归部门的全部子部门
     * @param string $lang 通讯录语言(默认zh_CN另外支持en_US)
     * @return array
     */
    public function getDepartmentList(int $parentId = 1,  bool $isFetchChild = false, string $lang = 'zh_CN')
    {
        return app(Lists::class)->execute([
            RequestParams::DEPARTMENT['get_department_list']['parent_id'] => $parentId,
            RequestParams::DEPARTMENT['get_department_list']['fetch_child'] => $isFetchChild,
            RequestParams::DEPARTMENT['get_department_list']['lang'] => $lang,
        ]);
    }


    /**
     * 获取部门详情
     *
     * @param int $id 部门ID
     * @param string $lang 通讯录语言(默认zh_CN另外支持en_US)
     * @return array
     */
    public function getDepartmentInfo(int $id, string $lang = 'zh_CN')
    {
        return app(Info::class)->execute([
            RequestParams::DEPARTMENT['get_department_info']['id'] => $id,
            RequestParams::DEPARTMENT['get_department_info']['lang'] => $lang,
        ]);
    }

    /**
     * 创建部门
     *
     * @param string $name 部门名称。长度限制为1~64个字符。不允许包含字符‘-’‘，’以及‘,’。
     * @param int $parentId 父部门id。根部门id为1
     * @param int $order 在父部门中的次序值。order值小的排序靠前
     * @param bool $createDeptGroup 是否创建一个关联此部门的企业群，默认为false
     * @param bool $deptHiding 是否隐藏部门, true表示隐藏, false表示显示
     * @param array $deptPerimits 可以查看指定隐藏部门的其他部门列表，如果部门隐藏，则此值生效，取值为其他的部门id组成的的字符串，使用 | 符号进行分割。总数不能超过200。
     * @param array $userPerimits 可以查看指定隐藏部门的其他人员列表，如果部门隐藏，则此值生效，取值为其他的人员userid组成的的字符串，使用| 符号进行分割。总数不能超过200。
     * @param bool $outerDept 是否本部门的员工仅可见员工自己, 为true时，本部门员工默认只能看到员工自己
     * @param array $outerPermitDepts 本部门的员工仅可见员工自己为true时，可以配置额外可见部门，值为部门id组成的的字符串，使用|符号进行分割。总数不能超过200。
     * @param array $outerPermitUsers 本部门的员工仅可见员工自己为true时，可以配置额外可见人员，值为userid组成的的字符串，使用|符号进行分割。总数不能超过200。
     * @param string|null $sourceIdentifier 部门标识字段，开发者可用该字段来唯一标识一个部门，并与钉钉外部通讯录里的部门做映射
     * @return mixed
     */
    public function createDepartment(string $name, int $parentId,
        int $order = 0, bool $createDeptGroup = false, bool $deptHiding = false, array $deptPerimits = [],
        array $userPerimits = [], bool $outerDept = false, array $outerPermitDepts = [], array $outerPermitUsers = [],
        string $sourceIdentifier = null
    )
    {
        return app(Create::class)->execute([
            RequestParams::DEPARTMENT['create_department']['name'] => $name,
            RequestParams::DEPARTMENT['create_department']['parent_id'] => $parentId,
            RequestParams::DEPARTMENT['create_department']['order'] => $order,
            RequestParams::DEPARTMENT['create_department']['create_dept_group'] => $createDeptGroup,
            RequestParams::DEPARTMENT['create_department']['dept_hiding'] => $deptHiding,
            RequestParams::DEPARTMENT['create_department']['dept_perimits'] => $deptPerimits,
            RequestParams::DEPARTMENT['create_department']['user_perimits'] => $userPerimits,
            RequestParams::DEPARTMENT['create_department']['outer_dept'] => $outerDept,
            RequestParams::DEPARTMENT['create_department']['outer_permit_depts'] => $outerPermitDepts,
            RequestParams::DEPARTMENT['create_department']['outer_permit_users'] => $outerPermitUsers,
            RequestParams::DEPARTMENT['create_department']['source_identifier'] => $sourceIdentifier,
        ]);
    }

    /**
     * 创建部门
     *
     * @param string $name 部门名称。长度限制为1~64个字符。不允许包含字符‘-’‘，’以及‘,’。
     * @param int $parentId 父部门id。根部门id为1
     * @param int $order 在父部门中的次序值。order值小的排序靠前
     * @param bool $createDeptGroup 是否创建一个关联此部门的企业群，默认为false
     * @param bool $deptHiding 是否隐藏部门, true表示隐藏, false表示显示
     * @param array $deptPerimits 可以查看指定隐藏部门的其他部门列表，如果部门隐藏，则此值生效，取值为其他的部门id组成的的字符串，使用 | 符号进行分割。总数不能超过200。
     * @param array $userPerimits 可以查看指定隐藏部门的其他人员列表，如果部门隐藏，则此值生效，取值为其他的人员userid组成的的字符串，使用| 符号进行分割。总数不能超过200。
     * @param bool $outerDept 是否本部门的员工仅可见员工自己, 为true时，本部门员工默认只能看到员工自己
     * @param array $outerPermitDepts 本部门的员工仅可见员工自己为true时，可以配置额外可见部门，值为部门id组成的的字符串，使用|符号进行分割。总数不能超过200。
     * @param array $outerPermitUsers 本部门的员工仅可见员工自己为true时，可以配置额外可见人员，值为userid组成的的字符串，使用|符号进行分割。总数不能超过200。
     * @param string|null $sourceIdentifier 部门标识字段，开发者可用该字段来唯一标识一个部门，并与钉钉外部通讯录里的部门做映射
     * @return mixed
     */
    public function updateDepartment( int $id, string $name = null,
         int $order = 0, bool $createDeptGroup = false, bool $deptHiding = false, array $deptPerimits = [],
         array $userPerimits = [], bool $outerDept = false, array $outerPermitDepts = [], array $outerPermitUsers = [],
         string $sourceIdentifier = null
    )
    {
        return app(Update::class)->execute([
            RequestParams::DEPARTMENT['update_department']['name'] => $name,
            RequestParams::DEPARTMENT['update_department']['id'] => $id,
            RequestParams::DEPARTMENT['update_department']['order'] => $order,
            RequestParams::DEPARTMENT['update_department']['create_dept_group'] => $createDeptGroup,
            RequestParams::DEPARTMENT['update_department']['dept_hiding'] => $deptHiding,
            RequestParams::DEPARTMENT['update_department']['dept_perimits'] => $deptPerimits,
            RequestParams::DEPARTMENT['update_department']['user_perimits'] => $userPerimits,
            RequestParams::DEPARTMENT['update_department']['outer_dept'] => $outerDept,
            RequestParams::DEPARTMENT['update_department']['outer_permit_depts'] => $outerPermitDepts,
            RequestParams::DEPARTMENT['update_department']['outer_permit_users'] => $outerPermitUsers,
            RequestParams::DEPARTMENT['update_department']['source_identifier'] => $sourceIdentifier,
        ]);
    }

    /**
     * 删除部门
     *
     * @param int $id 部门ID
     * @param string $lang 通讯录语言(默认zh_CN另外支持en_US)
     * @return array
     */
    public function deleteDepartment(int $id)
    {
        return app(Delete::class)->execute([
            RequestParams::DEPARTMENT['delete_department'] => $id
        ]);
    }

    /**
     * 查询部门的所有上级父部门路径
     *
     * @param int $id 部门ID
     * @param string $lang 通讯录语言(默认zh_CN另外支持en_US)
     * @return array
     */
    public function getAllParentDaepartment(int $id)
    {
        return app(AllParent::class)->execute([
            RequestParams::DEPARTMENT['get_all_parent_daepartment'] => $id
        ]);
    }

    /**
     * 获取部门成员
     *
     * @param int $departmentId
     * @param string $order
     * @param int $size
     * @param int $offset
     * @param string $lang
     * @return mixed
     */
    public function getUserSimpleList(int $departmentId, string $order = 'entry_asc', int $size = 30, $offset = 0, string $lang = 'zh_CN')
    {
        return app(SimpleList::class)->execute([
            RequestParams::USERS['get_user_simple_list']['department_id'] => $departmentId,
            RequestParams::USERS['get_user_simple_list']['order'] => $order,
            RequestParams::USERS['get_user_simple_list']['size'] => $size,
            RequestParams::USERS['get_user_simple_list']['offset'] => $offset,
            RequestParams::USERS['get_user_simple_list']['lang'] => $lang,
        ]);
    }

    /**
     * 获取部门成员 (详情)
     *
     * @param int $departmentId
     * @param string $order
     * @param int $size
     * @param int $offset
     * @param string $lang
     * @return mixed
     */
    public function getUserDetailsList(int $departmentId, string $order = 'entry_asc', int $size = 30, $offset = 0, string $lang = 'zh_CN')
    {
        return app(DetailsList::class)->execute([
            RequestParams::USERS['get_user_simple_list']['department_id'] => $departmentId,
            RequestParams::USERS['get_user_simple_list']['order'] => $order,
            RequestParams::USERS['get_user_simple_list']['size'] => $size,
            RequestParams::USERS['get_user_simple_list']['offset'] => $offset,
            RequestParams::USERS['get_user_simple_list']['lang'] => $lang,
        ]);
    }



}