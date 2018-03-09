# 调用文档

## 获取子部门ID列表

#### array Ding::getDepartmentIds(int $parentId = 1)

- 参数说明

    参数 | 描述
    --- | --- 
    $parentId | 可选。父部门ID， 1 根部门ID
    
- 返回结果
    ```php
    [2,3,4,5,6,...]
    ```
    
## 获取部门列表

#### array Ding::getDepartmentList(int $parentId = 1,  bool $isFetchChild = false, string $lang = 'zh_CN')

- 参数说明

    参数 | 描述
    --- | --- 
    $parentId | 可选。父部门ID， 1 根部门ID
    $isFetchChild | 可选。是否递归部门的全部子部门，ISV微应用固定传递false。
    $lang | 可选。通讯录语言(默认zh_CN另外支持en_US)
    
- 返回结果
    ```php
    [
      0 => {
        "createDeptGroup": true // 是否同步创建一个关联此部门的企业群, true表示是, false表示不是
        "name": "技术支持中心" // 部门名称
        "id": 61174940 // 部门id
        "autoAddUser": true // 当群已经创建后，是否有新人加入部门会自动加入该群, true表示是, false表示不是
        "parentid": 1 // 父部门id
      },
      ......
    ]
    ```
    
## 获取部门详情

#### array Ding::getDepartmentInfo(int $id = 1,  string $lang = 'zh_CN')

- 参数说明

    参数 | 描述
    --- | --- 
    $id | 必选。部门ID
    $lang | 可选。通讯录语言(默认zh_CN另外支持en_US)
    
- 返回结果
    ```php
    [
      "errcode" => 0 // 返回码
      "userPerimits" => "" // 可以查看指定隐藏部门的其他人员列表，如果部门隐藏，则此值生效，取值为其他的人员userid组成的的字符串，使用|符号进行分割
      "orgDeptOwner" => "manager7447" // 企业群群主
      "outerDept" => false // 是否本部门的员工仅可见员工自己, 为true时，本部门员工默认只能看到员工自己
      "errmsg" => "ok" // 对返回码的文本描述内容
      "deptManagerUseridList" => "" // 部门的主管列表,取值为由主管的userid组成的字符串，不同的userid使用|符号进行分割
      "groupContainSubDept" => true // 部门群是否包含子部门
      "outerPermitUsers" => "" // 本部门的员工仅可见员工自己为true时，可以配置额外可见人员，值为userid组成的的字符串，使用| 符号进行分割
      "outerPermitDepts" => "" // 本部门的员工仅可见员工自己为true时，可以配置额外可见部门，值为部门id组成的的字符串，使用|符号进行分割
      "deptPerimits" => "" // 可以查看指定隐藏部门的其他部门列表，如果部门隐藏，则此值生效，取值为其他的部门id组成的的字符串，使用|符号进行分割
      "createDeptGroup" => true // 是否同步创建一个关联此部门的企业群, true表示是, false表示不是
      "name" => "xiewh" // 部门名称
      "id" => 1 // 部门id
      "autoAddUser" => true // 当群已经创建后，是否有新人加入部门会自动加入该群, true表示是, false表示不是
      "deptHiding" => false // 是否隐藏部门, true表示隐藏, false表示显示
      "order" => 0, // 在父部门中的次序值
      "parentid" => 1 // 父部门id，根部门为1
      "sourceIdentifier" => "" // 部门标识字段，开发者可用该字段来唯一标识一个部门，并与钉钉外部通讯录里的部门做映射,
    ]
    ```
    
## 创建部门

#### array Ding::createDepartment(string $name, int $parentId, [...])

- 参数说明

    参数 |	参数类型 |	必须 |	说明
    --- | --- | --- | ---
    name | String | 是 | 部门名称。长度限制为1~64个字符。不允许包含字符‘-’‘，’以及‘,’。
    parentId | bool | 是 | 父部门id。根部门id为1
    order | bool | 否 | 在父部门中的次序值。order值小的排序靠前
    createDeptGroup | Boolean | 否 | 是否创建一个关联此部门的企业群，默认为false
    deptHiding | Boolean | 否 | 是否隐藏部门, true表示隐藏, false表示显示
    deptPerimits | array | 否 | 可以查看指定隐藏部门的其他部门列表，如果部门隐藏，则此值生效，取值为其他的部门id组成的的字符串, 总数不能超过200。
    userPerimits | array | 否 | 可以查看指定隐藏部门的其他人员列表，如果部门隐藏，则此值生效，取值为其他的人员userid组成的的字符串。总数不能超过200。
    outerDept | Boolean | 否 | 是否本部门的员工仅可见员工自己, 为true时，本部门员工默认只能看到员工自己
    outerPermitDepts | array | 否 | 本部门的员工仅可见员工自己为true时，可以配置额外可见部门，值为部门id组成的的字符串。总数不能超过200。
    outerPermitUsers | array | 否 | 本部门的员工仅可见员工自己为true时，可以配置额外可见人员，值为userid组成的的字符串。总数不能超过200。
    sourceIdentifier | String | 否 | 部门标识字段，开发者可用该字段来唯一标识一个部门，并与钉钉外部通讯录里的部门做映射
    
- 返回结果
    ```php
    [
      "errcode" => 0 // 返回码
      "errmsg" => "ok" // 对返回码的文本描述内容
      "id" => 61264910 // 创建的部门id
    ]
    ```

## 修改部门

#### array Ding::updateDepartment(int $id, [...])

- 参数说明

    参数 |	参数类型 |	必须 |	说明
    --- | --- | --- | ---
    id | bool | 是 | 部门id
    name | String | 是 | 部门名称。长度限制为1~64个字符。不允许包含字符‘-’‘，’以及‘,’。
    order | bool | 否 | 在父部门中的次序值。order值小的排序靠前
    createDeptGroup | Boolean | 否 | 是否创建一个关联此部门的企业群，默认为false
    deptHiding | Boolean | 否 | 是否隐藏部门, true表示隐藏, false表示显示
    deptPerimits | array | 否 | 可以查看指定隐藏部门的其他部门列表，如果部门隐藏，则此值生效，取值为其他的部门id组成的的字符串, 总数不能超过200。
    userPerimits | array | 否 | 可以查看指定隐藏部门的其他人员列表，如果部门隐藏，则此值生效，取值为其他的人员userid组成的的字符串。总数不能超过200。
    outerDept | Boolean | 否 | 是否本部门的员工仅可见员工自己, 为true时，本部门员工默认只能看到员工自己
    outerPermitDepts | array | 否 | 本部门的员工仅可见员工自己为true时，可以配置额外可见部门，值为部门id组成的的字符串。总数不能超过200。
    outerPermitUsers | array | 否 | 本部门的员工仅可见员工自己为true时，可以配置额外可见人员，值为userid组成的的字符串。总数不能超过200。
    sourceIdentifier | String | 否 | 部门标识字段，开发者可用该字段来唯一标识一个部门，并与钉钉外部通讯录里的部门做映射
    
- 返回结果
    ```php
    [
      "errcode" => 0 // 返回码
      "errmsg" => "ok" // 对返回码的文本描述内容
      "id" => 61264910 // 创建的部门id
    ]
    ```
    
## 删除部门

#### array Ding::deleteDepartment(int $id)

- 参数说明

    参数 |	参数类型 |	必须 |	说明
    --- | --- | --- | ---
    id | int | 是 | 部门ID 
    
- 返回结果
    ```php
    [
      "errcode" => 0 // 返回码
      "errmsg" => "ok" // 对返回码的文本描述内容
    ]
    ```
    
## 查询部门的所有上级父部门路径

#### array Ding::getAllParentDaepartment(int $id)

- 参数说明

    参数 |	参数类型 |	必须 |	说明
    --- | --- | --- | ---
    id | int | 是 | 部门ID 
    
- 返回结果
    ```php
    [
      0 => 3
      1 => 2
      2 => 1
    ]
    ```