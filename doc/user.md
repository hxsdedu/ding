# 用户相关操作

## 获取部门成员

#### string Ding::getUserSimpleList(int $departmentId, string $order = 'entry_asc', int $size = 30, $offset = 0, string $lang = 'zh_CN')

- 参数说明

    参数 |	参数类型 |	必须 |	说明
    --- | --- | --- | ---
    $departmentId | int | 是 | 部门ID 
    $order | string | 否 | 排序， 支持分页查询，部门成员的排序规则，默认不传是按自定义排序；entry_asc代表按照进入部门的时间升序，entry_desc代表按照进入部门的时间降序，modify_asc代表按照部门信息修改时间升序，modify_desc代表按照部门信息修改时间降序，custom代表用户定义(未定义时按照拼音)排序
    $size | int | 否 | 支持分页查询，与offset参数同时设置时才生效，此参数代表分页大小，最大100
    $offset | int | 否 | 支持分页查询，与size参数同时设置时才生效，此参数代表偏移量
    $lang | string | 否 | 通讯录语言(默认zh_CN另外支持en_US)
    
- 返回结果
    ```php
      [
        "errcode" => 0 // 返回码
        "hasMore" => false // 在分页查询时返回，代表是否还有下一页更多数据
        "errmsg" => "ok" 
        "userlist" => array:1 [
          0 => {
            "name": "大老板" // 成员名称
            "userid": "888888" // 员工唯一标识ID（不可修改）
          }
        ]
      ]
    ```
    
## 获取部门成员 (详情)

#### string Ding::getUserDetailsList(int $departmentId, string $order = 'entry_asc', int $size = 30, $offset = 0, string $lang = 'zh_CN')

- 参数说明

    参数 |	参数类型 |	必须 |	说明
    --- | --- | --- | ---
    $departmentId | int | 是 | 部门ID 
    $order | string | 否 | 排序， 支持分页查询，部门成员的排序规则，默认不传是按自定义排序；entry_asc代表按照进入部门的时间升序，entry_desc代表按照进入部门的时间降序，modify_asc代表按照部门信息修改时间升序，modify_desc代表按照部门信息修改时间降序，custom代表用户定义(未定义时按照拼音)排序
    $size | int | 否 | 支持分页查询，与offset参数同时设置时才生效，此参数代表分页大小，最大100
    $offset | int | 否 | 支持分页查询，与size参数同时设置时才生效，此参数代表偏移量
    $lang | string | 否 | 通讯录语言(默认zh_CN另外支持en_US)
    
- 返回结果
    ```php
      [
        "errcode" => 0
        "hasMore" => false
        "errmsg" => "ok"
        "userlist" => array:1 [
          0 => {
            "unionid": "xxxxxx"
            "openId": "xxxxxx"
            "remark": "我是大老板"
            "userid": "88888888"
            "isBoss": false
            "hiredDate": 123456789000
            "tel": "8888"
            "department":[
              0 => 614128761
            ]
            "workPlace": "北京"
            "email": "xxxx@xxxx.com"
            "order": 176397036784920512
            "dingId": "$:L123P_v1:$DRfewIUFec9uRBq4zvj3w=="
            "isLeader": false
            "mobile": "11111111111"
            "active": true
            "isAdmin": true
            "avatar": "http://static.dingtalk.com/media/lADPA123COG84MFade421HTbNBNrNBNo_1242_1242.jpg"
            "isHide": false
            "orgEmail": "xxx@xxx.onaliyun.com"
            "jobnumber": "BJ888888"
            "name": "大板板"
            "position": "大老板"
          }
        ]
      ]
    ```
    
    参数 | 说明
    --- | --- 
    errcode | 返回码
    errmsg | 对返回码的文本描述内容
    hasMore | 在分页查询时返回，代表是否还有下一页更多数据
    userlist | 成员列表
    userid | 员工唯一标识ID（不可修改）
    order | 表示人员在此部门中的排序，列表是按order的倒序排列输出的，即从大到小排列输出的（OA后台里面调整了顺序的话order才有值）
    dingId | 钉钉ID（不可修改）
    unionid | 在当前isv全局范围内唯一标识一个用户的身份,用户无法修改
    mobile | 手机号（ISV不可见）
    tel | 分机号（ISV不可见）
    workPlace | 办公地点（ISV不可见）
    remark | 备注（ISV不可见）
    isAdmin | 是否是企业的管理员, true表示是, false表示不是
    isBoss | 是否为企业的老板, true表示是, false表示不是 （不能通过接口设置,可以通过OA后台设置）
    isHide | 是否隐藏号码, true表示是, false表示不是
    isLeader | 是否是部门的主管, true表示是, false表示不是
    name | 成员名称
    active | 表示该用户是否激活了钉钉
    department | 成员所属部门id列表
    position | 职位信息
    email | 员工的邮箱
    orgEmail | 员工的企业邮箱
    avatar | 头像url
    jobnumber | 员工工号
    hiredDate | 入职时间
    extattr | 扩展属性，可以设置多种属性(但手机上最多只能显示10个扩展属性，具体显示哪些属性，请到OA管理后台->设置->通讯录信息设置和OA管理后台->设置->手机端显示信息设置)