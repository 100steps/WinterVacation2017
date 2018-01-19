# 用户系统

## 登录接口
* URL路由访问地址：`/forum/user/login`
* 文件实际路径：`/forum/user/login.php`
* 访问方式：`POST`
* 访问条件限制：无
### POST 请求格式：`JSON`
```JavaScript
{
	"username": "test", /* 登录用户名 */
	"password": "...", /* 用户密码（3次MD5加密） */
	"captcha": "aaaaa" /* 验证码（详见验证码接口） */
}
```
### POST 返回格式：`JSON`
* 登录成功
```JavaScript
{
    "status": "ok", /* 登录状态：成功 */
    "go": "/forum/main" /* 登录后跳转的页面 */
}
```
* 登录失败
```JavaScript
{
    "status": "failed", /* 登录状态：失败 */
    "reason": "用户名或密码错误。" /* 登录失败的原因（展示给用户） */
}
```

## 模板接口：获得注册/修改用户信息时需要填写的信息
* URL路由访问地址：`/forum/user/template`
* 文件实际路径：`/forum/user/getTemplate.php`
* 访问方式：`GET`
* 访问条件限制：无
### GET 请求格式：无需参数
### GET 返回格式：`JSON`
```JavaScript
/*
	返回一个JSON数组，数组中的每个元素都是一个JSON对象
	其中，额外参数有must（必填项）、password（需要遮挡）、notShowInReg（注册界面不用填写，比如头像）、file（上传文件）
*/
[
    {
        "key": "username", /* 该项在提交时的名称 */
        "desc": "用户名", /* 展示给用户的名称 */
        "limit": "3~15个英文字符/数字", /* 展示给用户的placeholder */
        "regex": "[0-9a-zA-Z._\-]{3,15}", /* 限制输入的正则表达式 */
        "flag": ["must"] /* 额外参数（见上） */
    }, {
        "key": "password",
        "desc": "密码",
        "limit": "6~20位字符", 
        "regex": ".{6,20}", 
        "flag": ["must", "password"]
    }, {
        "key": "alias",
        "desc": "昵称",
        "limit": "6~20位字符", 
        "regex": ".{6,20}", 
        "flag": ["must"]
    }, {
        "key": "email",
        "desc": "邮箱",
        "limit": "输入您的邮箱", 
        "regex": "[0-9a-zA-Z._\-]{1,20}@[0-9a-zA-Z._\-]{1,20}\.[0-9a-z]{2,6}", 
        "flag": [""]
    }, {
        "key": "captcha",
        "desc": "验证码",
        "limit": "输入图中的5位字符", 
        "regex": "[0-9a-zA-Z]{5}", 
        "flag": ["must"]
    }, {
        "key": "avatar",
        "desc": "头像",
        "limit": "", 
        "regex": "", 
        "flag": ["notShowInReg", "file"]
    } /* TODO */
]
```

## 注册接口：提交注册信息
* URL路由访问地址：`/forum/user/reg`
* 文件实际路径：`/forum/user/reg.php`
* 访问方式：`POST`
* 访问条件限制：无
### POST 请求格式：`JSON`
```JavaScript
/* 此处每一个JSON的key都是上述接口中的key值，value对应的就是页面上用户输入的数据 */
{
    "username": "test",
    "password": "123456",
    "alias": "I'm angry",
    "email": "123456@qq.com",
    "captcha": "aaaaa"
}
```
### POST 返回格式：`JSON`
* 注册成功
```JavaScript
{
    "status": "ok", /* 注册状态：成功 */
    "go": "/forum/main" /* 注册后跳转的页面 */
}
```
* 注册失败
```JavaScript
{
    "status": "failed", /* 注册状态：失败 */
    "reason": "您的姿势水平不够高，论坛不对您开放注册。" /* 注册失败的原因（展示给用户） */
}
```

## 个人信息接口0：获取个人信息
* URL路由访问地址：`/forum/user/info`
* 文件实际路径：`/forum/user/getUserInfo.php`
* 访问方式：`GET`
* 访问条件限制：登录后的用户
### GET 请求格式：不带参数 或 `JSON`
* 不带参数：返回用户自身信息；
* 带参数：查询用户信息
```JavaScript
// 注意：只有管理员等有权限的用户访问才会给出用户完整信息
// 提示：以下查询参数只需指定其中一个即可
{
    "userID": 1,
    "username": "test",
    /* ... */
}
```
### GET 返回格式：`JSON`
```JavaScript
// 注意：返回的是JSON数组（为了兼容查询用户）
[
    {
        "username": "test",
        "alias": "I'm angry",
        "email": "123456@qq.com",
        "avatar": "/image/avatar/1a2b3c4d5e6f7890.jpg",
        /* TODO */
    }
]
```

## 个人信息接口1：更新个人信息
* URL路由访问地址：`/forum/user/info`
* 文件实际路径：`/forum/user/putUserInfo.php`
* 访问方式：`PUT`
* 访问条件限制：登录后的用户、管理员
### PUT 请求格式：`JSON`
* 不带参数：更新用户自身信息；
* 带参数：（管理员）更新指定用户信息
```JavaScript
// 注意：只有管理员等有权限的用户才可以更新其它用户的信息，否则403
{
    "userID": 1,
    "username": "test",
    "alias": "Hong Kong Reporter",
    /* ... */
}
```
### PUT 返回格式：`JSON`
* 更新成功
```JavaScript
{
    "status": "ok",
    "go": "/forum/user/info"
}
```
* 更新失败
```JavaScript
{
    "status": "failed",
    "reason": "你的资料被钦定了，没有中央的决定不能乱改。"
}
```

## 个人信息接口2：上传个人头像
* URL路由访问地址：`/forum/user/avatar`
* 文件实际路径：`/forum/user/putUserAvatar.php`
* 访问方式：`PUT`
* 访问条件限制：登录后的用户，且头像大小不能大于 1 MByte
### PUT 请求类型：`image/jpeg`
### PUT 返回格式：`JSON`
* 上传成功
```JavaScript
{
    "status": "ok",
    "resaddr": "/image/avatar/1a2b3c4d5e6f7890.jpg"
}
```
* 上传失败
```JavaScript
{
    "status": "failed",
    "reason": "服务器空间/权限不足，无法创建头像。"
}
```
