# 论坛核心接口

## 版块的接口

### 获取版块列表
* URL路由访问地址：`/api/forum`
* 文件实际路径：`/api/forum/getCategoryList.php`
* 访问方式：`GET`
* 访问条件限制：任何人

#### GET 请求格式：标准GET请求

#### GET 返回格式：`JSON`
```JavaScript
[
    {
        "id": 1,
    	"name": "water",
        "alias": "灌水区",
        "create_time": 1516421353371,
        "modify_time": 1516421388888,
        "icon": "water",
        "topic": 666,
        "reply": 6666,
        "owner": "admin"
    }, /* ... */
]
```
 返回一个JSON数组，数组中的JSON说明如下：
 * `id`：版块id
 * `name`：版块英文名（展示在URL中）
 * `alias`：版块中文名
 * `create_time`：版块创建的时间戳
 * `modify_time`：版块修改的时间戳
 * `icon`：帖子的图标hash
 * `topic`：版块的帖子数量
 * `reply`：版块的回帖数量
 * `owner`：版主用户名


### 创建版块
* URL路由访问地址：`/api/forum`
* 文件实际路径：`/api/forum/createCategory.php`
* 访问方式：`POST`
* 访问条件限制：管理员

#### POST 请求格式：标准POST请求
ajax中`data`字段对应的json如下
```JavaScript
{
    "name": "water",
    "alias": "灌水区",
    "icon": "water",
    "owner": "admin",
    "captcha": "aaaaa"
}
```
其中：
* `captcha`：验证码
* `name`：版块新英文名称
* `alias`：版块新中文名称
* `icon`：版块新图标
* `owner`：版块新版主用户名

#### POST 返回格式：`JSON`
```JavaScript
{
    "status": "ok",
    "go": "/forum/"
}
```

### 修改版块信息
* URL路由访问地址：`/api/forum/{Category}`
* 文件实际路径：`/api/forum/modifyCategory.php`
* 访问方式：`PUT`
* 访问条件限制：管理员、版主

#### PUT 请求格式：标准PUT请求
* URL中，`{Category}`为版块的**英文名**
* ajax中`data`字段对应的json与创建版块相同，此处略

#### PUT 返回格式：`JSON`
```JavaScript
{
    "status": "ok",
    "go": "/forum/"
}
```

### 删除版块
* URL路由访问地址：`/api/forum/{Category}`
* 文件实际路径：`/api/forum/deleteCategory.php`
* 访问方式：`DELETE`
* 访问条件限制：版主、管理员

#### DELETE 请求格式：标准DELETE请求
ajax中`data`字段对应的json如下
```JavaScript
{
    "captcha": "aaaa"
}
```
其中：
* `captcha`：验证码

#### DELETE 返回格式：`JSON`
返回格式同修改版块接口，此处略。

## 帖子的接口

### 获取帖子列表
* URL路由访问地址：`/api/forum/{Category}?&count={Count}&page={Page}&sort={Sort}`
* 文件实际路径：`/api/forum/getTopicList.php`
* 访问方式：`GET`
* 访问条件限制：可以访问本版块的用户

#### GET 请求格式：标准GET请求
* `{Category}`：帖子所在的版块**英文名**
* `{Count}`：每页显示的帖子数（最大不超过100）
* `{Page}`：第几页
* `{Sort}`：排序方法，可以是
  * `reply_time_dsc`（按回帖时间从后向前，默认）
  * `create_time_dsc`（按发帖时间从前向后）
  * `reply_dsc`（按回复数量从高到低）

#### GET 返回格式：`JSON`
* 登录成功
```JavaScript
[
    {
        "id": 9876,
    	"title": "震惊！华南理工大学居然发生这种事情！",
        "author": "admin",
        "create_time": 1516421353371,
        "modify_time": 1516421388888,
        "last_reply_time": 1516421366666,
        "last_replier": "waterful",
        "icon": "hot",
        "view": 2147483647,
        "reply": 1024,
        "participant": 2,
        "top": 1,
        "draft": 0
    }, /* ... */
]
```
 返回一个JSON数组，数组中的JSON说明如下：
 * `id`：帖子id
 * `title`：帖子标题
 * `author`：帖子作者用户名
 * `create_time`：帖子创建的时间戳
 * `modify_time`：帖子修改的时间戳
 * `last_reply_time`：最后回复的时间戳
 * `last_replier`：最后回复的用户名
 * `icon`：帖子的图标hash
 * `view`：帖子的访问量
 * `reply`：帖子的回复数量
 * `participant`：参与回复的人员数量
 * `top`：是否置顶
 * `draft`：是否是草稿

### 发帖接口
* URL路由访问地址：`/api/forum/{Category}`
* 文件实际路径：`/api/forum/postTopic.php`
* 访问方式：`POST`
* 访问条件限制：登录后、有权在本版块发帖的用户

#### POST 请求格式：标准POST请求
ajax中`data`字段对应的json如下
```JavaScript
{
    "title": "震惊！华南理工大学居然发生这种事情！",
    "content": "<b>两个教官居然在操场上让一群学生坐着玩手机！这tm实在是太震惊了！</b>",
    "captcha": "abcd",
    "draft": 1,
    "top": 1, /* ... */
}
```
 提交一个JSON对象，其中：
 * `title`：帖子名称
 * `content`：帖子内容
 * `captcha`：验证码
 * `draft`：是否为草稿
 * `top`：是否为置顶

#### POST 返回格式：`JSON`
* 发帖成功
```JavaScript
{
    "status": "ok",
    "go": "/forum/t/guanshui/123"
}
```
* 发帖失败
```JavaScript
{
    "status": "failed",
    "reason": "您没有在此版块发帖的权限。"
}
```

### 获取帖子内容
* URL路由访问地址：`/api/forum/{Category}/{TopicID}?&count={Count}&page={Page}&username={UserName}`
* 文件实际路径：`/api/forum/getTopicContent.php`
* 访问方式：`GET`
* 访问条件限制：可以访问本版块的用户

#### GET 请求格式：标准GET请求
* `{Category}`：帖子所在的版块名称
* `{TopicID}`：帖子的ID
* `{Count}`：每页显示的回帖数（最大不超过100）
* `{Page}`：第几页
* `{UserName}`：只看某用户的帖子的用户名

#### GET 返回格式：`JSON`
* 成功获取
```JavaScript
[
    {
        "id": 1,
        "reply_id": 0,
        "author": "admin",
        "create_time": 1516421353371,
        "modify_time": 1516421388888,
        "content": "<b>两个教官居然在操场上让一群学生坐着玩手机！这tm实在是太震惊了！</b>"
    }, {
        "id": 2,
        "reply_id": 1,
        "author": "waterful",
        "create_time": 1516421366666,
        "modify_time": 1516421388888,
        "content": "老子还在宿舍玩手机呢:lol:"
    }
]
```
 返回一个JSON数组，数组中的JSON说明如下：
   * `id`：楼层号
   * `reply_id`：评论的楼层号（相当于引用）
   * `author`：本楼层作者用户名
   * `create_time`：此楼层的创建时间戳
   * `modify_time`：此楼层的修改时间戳
   * `content`：此楼层的内容

### 回帖接口

* URL路由访问地址：`/api/forum/{Category}/{TopicID}`
* 文件实际路径：`/api/forum/postTopicReply.php`
* 访问方式：`POST`
* 访问条件限制：登录后、有权在本版块回帖的用户

#### POST 请求格式：标准POST请求
ajax中`data`字段对应的json如下
```JavaScript
{
    "content": "<b>两个教官居然在操场上让一群学生坐着玩手机！这tm实在是太震惊了！</b>",
    "reply_id": 1,
    "captcha": "abcd",
}
```
 * `content`：回帖内容
 * `reply_id`：回复的楼层号，0为不回复任何人（仅跟帖）
 * `captcha`：回帖验证码

#### POST 返回格式：`JSON`
与发帖接口类似，此处略

### 修改帖子接口
* URL路由访问地址：`/api/forum/{Category}/{TopicID}`
* 文件实际路径：`/api/forum/modifyTopic.php`
* 访问方式：`PUT`
* 访问条件限制：楼主、管理员

#### PUT 请求格式：标准PUT请求
请求格式同发帖接口，此处略。

#### PUT 返回格式：`JSON`
返回格式同发帖接口，此处略。

### 修改回帖接口
* URL路由访问地址：`/api/forum/{Category}/{TopicID}/{ReplyID}`
* 文件实际路径：`/api/forum/modifyTopicReply.php`
* 访问方式：`PUT`
* 访问条件限制：层主、管理员

#### PUT 请求格式：标准PUT请求
请求格式同发帖接口，此处略。

#### PUT 返回格式：`JSON`
返回格式同发帖接口，此处略。

### 删除帖子接口
* URL路由访问地址：`/api/forum/{Category}/{TopicID}`
* 文件实际路径：`/api/forum/deleteTopic.php`
* 访问方式：`DELETE`
* 访问条件限制：楼主、版主、管理员

#### DELETE 请求格式：标准DELETE请求
ajax中`data`字段对应的json如下
```JavaScript
{
    "captcha": "aaaa"
}
```
请求格式是JSON对象，其中：
* `captcha`：验证码

#### DELETE 返回格式：`JSON`
返回格式同发帖接口，此处略。

### 删除回帖接口
* URL路由访问地址：`/api/forum/{Category}/{TopicID}/{ReplyID}`
* 文件实际路径：`/api/forum/deleteTopicReply.php`
* 访问方式：`DELETE`
* 访问条件限制：层主、管理员

#### DELETE 请求格式：标准DELETE请求
请求格式同删帖接口，此处略。

#### DELETE 返回格式：`JSON`
返回格式同删帖接口，此处略。

