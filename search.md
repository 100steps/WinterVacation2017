# 搜索接口

## 搜索用户
* URL路由访问地址：`/api/search/user?count={Count}&page={Page}`
* 文件实际路径：`/api/user/search.php`
* 访问方式：`POST`
* 访问条件限制：任何人

### POST 请求格式：标准POST请求
* `{Count}`：每页显示的个数
* `{Page}`：第几页
* ajax中`data`字段对应的json如下
```JavaScript
{
    "captcha": "aaaaa",
    "content": "管理"
}
```
### POST 返回格式：`JSON`
```JavaScript
[
    {
    	"username": "admin",
        "alias": "管理员",
        "avatar": "",
    }, /* ... */
]
```
 返回一个JSON数组，数组中的JSON说明如下：
 * `username`：搜索到的用户名
 * `alias`：搜索到的用户昵称
 * `avatar`：搜索到用户的头像

## 搜索帖子及内容
* URL路由访问地址：`/api/search/content?count={Count}&page={Page}&category={Category}&topic={Topic}`
* 文件实际路径：`/api/forum/search.php`
* 访问方式：`POST`
* 访问条件限制：任何人

### POST 请求格式：标准POST请求
* `{Count}`：每页显示的个数
* `{Page}`：第几页
* `{Category}`：（可选）指定版块
* `{Topic}`：（可选）指定帖子，必须指定版块
* ajax中`data`字段对应的json如下
```JavaScript
{
    "captcha": "aaaaa",
    "content": "灌水"
}
```
### POST 返回格式：`JSON`
```JavaScript
[
    {
    	"name": "water",
        "alias": "灌水区",
        "topic": [
            {
                "id": 2,
                "title": "震惊！",
                "create_time": 1234567890,
                "reply": [
                    {
                        "id": 3,
                        "author": "admin",
                        "create_time": 1234567890,
                        "content": "test"
                    }, /* ... */
                ]
            }, /* ... */
        ],
    }, /* ... */
]
```
 返回分级形式的JSON数组，详细解释见论坛接口。
