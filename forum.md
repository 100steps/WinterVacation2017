# 论坛核心接口

## 帖子的接口

### 获取帖子列表
* URL路由访问地址：`/api/t/{Category}?&c={Count}&p={Page}&s={Sort}`
* 文件实际路径：`/api/forum/getList.php`
* 访问方式：`GET`
* 访问条件限制：可以访问本板块的用户

#### GET 请求格式：标准GET请求
* `{Category}`：帖子所在的板块名称
* `{Count}`：每页显示的帖子数（最大不超过100）
* `{Page}`：第几页
* `{Sort}`：排序方法，可以是
 * `time_dsc`（按时间从后向前，默认）
 * `time_acs`（按时间从前向后）
 * `pop_dsc`（按人气从高到低）

#### GET 返回格式：`JSON`
* 登录成功
```JavaScript
[
    {
        "id": 9876,
        "category": "灌水区",
    	"title": "震惊！华南理工大学居然发生这种事情！",
        "author": "灌水大佬",
        "authorID": 123,
        "createTime": 1516421353371,
        "modifyTime": 1516421388888,
        "lastReplyTime": 1516421366666,
        "lastReplier": "百步梯萌新",
        "lastReplierID": 666,
        "icon": "/image/icon/hot.png",
        "view": 2147483647,
        "reply": 1024,
        "flag": ["top"]
    }, /* ... */
]
```
 返回一个JSON数组，数组中的JSON说明如下：
 * `id`：帖子id
 * `category`：板块名称
 * `title`：帖子标题
 * `author`：帖子作者
 * `authorID`：帖子作者id
 * `createTime`：帖子创建的时间戳
 * `modifyTime`：帖子修改的时间戳
 * `lastReplyTime`：最后回复的时间戳
 * `lastReplier`：最后回复的人
 * `lastReplierID`：最后回复者的ID
 * `icon`：帖子的图标
 * `view`：帖子的访问量
 * `reply`：帖子的回复数量
 * `flag`：特殊标记数组，其中的元素可以是
   * `"top"` 置顶

### 发帖接口
* URL路由访问地址：`/api/t/{Category}`
* 文件实际路径：`/api/forum/postTopic.php`
* 访问方式：`POST`
* 访问条件限制：登录后、有权在本板块发帖的用户

#### POST 请求格式：`JSON`
```JavaScript
{
    "title": "震惊！华南理工大学居然发生这种事情！",
    "content": "<b>两个教官居然在操场上让一群学生坐着玩手机！这tm实在是太震惊了！</b>",
    "captcha": "abcd",
    "flag": ["draft"], /* ... */
}
```
 提交一个JSON对象，其中：
 * `title`：帖子名称
 * `content`：帖子内容
 * `captcha`：验证码
 * `flag`：特殊标记数组，其中的元素可以是
   * `"draft"`草稿（不会给其它人看到）

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
    "reason": "您没有在此板块发帖的权限。"
}
```

### 获取帖子内容
* URL路由访问地址：`/api/t/{Category}/{TopicID}?&c={Count}&p={Page}&u={UserID}`
* 文件实际路径：`/api/forum/getTopic.php`
* 访问方式：`GET`
* 访问条件限制：可以访问本板块的用户

#### GET 请求格式：标准GET请求
* `{Category}`：帖子所在的板块名称
* `{TopicID}`：帖子的ID
* `{Count}`：每页显示的回帖数（最大不超过100）
* `{Page}`：第几页
* `{UserID}`：只看某用户的帖子的用户ID

#### GET 返回格式：`JSON`
* 成功获取
```JavaScript
{
    "id": 9876,
    "category": "灌水区"
    "title": "震惊！华南理工大学居然发生这种事情！",
    "author": "灌水大佬",
    "authorID": 123,
    "createTime": 1516421353371,
    "modifyTime": 1516421388888,
    "lastReplyTime": 1516421366666,
    "lastReplier": "百步梯萌新",
    "lastReplierID": 666,
    "icon": "/image/icon/hot.png",
    "view": 2147483647,
    "reply": 1024,
    "flag": ["top"]
    "content": [
        {
            "replyID": 0,
            "author": "灌水大佬",
            "authorID": 123,
            "commentCount": 2,
            "time": 1516421353371,
            "modifyTime": 1516421388888,
            "content": "<b>两个教官居然在操场上让一群学生坐着玩手机！这tm实在是太震惊了！</b>"
        }, {
            "replyID": 1,
            "author": "百步梯萌新",
            "authorID": 666,
            "commentCount": 0,
            "time": 1516421366666,
            "modifyTime": 1516421388888,
            "content": "老子还在宿舍玩手机呢:lol:"
        }
    ]
}
```
 返回一个JSON数组，数组中的JSON说明如下：
 * 上面大部分与获取帖子列表中的内容相同，此处略
 * `content`：帖子的所有内容，这是一个JSON数组，其中
   * `replyID`：楼层号
   * `author`：本楼层作者名
   * `authorID`：本楼层作者id
   * `commentCount`：评论条数
   * `time`：此楼层的创建时间戳
   * `modifyTime`：此楼层的修改时间戳
   * `content`：此楼层的内容

### 获取评论内容
* URL路由访问地址：`/api/t/{Category}/{TopicID}/{ReplyID}?&c={Count}&p={Page}`
* 文件实际路径：`/api/forum/getTopic.php`
* 访问方式：`GET`
* 访问条件限制：可以访问本板块的用户

#### GET 请求格式：标准GET请求
* `{Category}`：帖子所在的板块名称
* `{TopicID}`：帖子的ID
* `{ReplyID`：帖子楼层号
* `{Count}`：每页显示的评论数（最大不超过10）
* `{Page}`：第几页

#### GET 返回格式：`JSON`
* 成功获取
```JavaScript
{
    "replyID": 1,
    "author": "百步梯萌新",
    "authorID": 666,
    "commentCount": 1,
    "time": 1516421366666,
    "content": "老子还在宿舍玩手机呢:lol:"
    "comments": [
        {
            "commentID": 0,
            "author": "灌水大佬",
            "authorID": 123,
            "time": 1516421353371,
            "content": "<b>两个教官居然在操场上让一群学生坐着玩手机！这tm实在是太震惊了！</b>"
        }
    ]
}
```
 返回一个JSON数组，数组中的JSON说明如下：
 * 上面大部分与获取帖子内容中的内容相同，此处略
 * `comments`：帖子的评论，这是一个JSON数组，其中
   * `commentID`：第几个评论
   * `author`：本评论作者名
   * `author`：本评论作者id
   * `time`：此评论的创建时间戳
   * `content`：此评论的内容


### 回帖接口

* URL路由访问地址：`/api/t/{Category}/{TopicID}`
* 文件实际路径：`/api/forum/postTopicReply.php`
* 访问方式：`POST`
* 访问条件限制：登录后、有权在本板块回帖的用户

#### POST 请求格式：`JSON`
```JavaScript
{
    "content": "<b>两个教官居然在操场上让一群学生坐着玩手机！这tm实在是太震惊了！</b>",
    "captcha": "abcd",
}
```
 * `content`：回帖内容
 * `captcha`：回帖验证码

#### POST 返回格式：`JSON`
与发帖接口类似，此处略

### 评论接口

* URL路由访问地址：`/api/t/{Category}/{TopicID}/{ReplyID}`
* 文件实际路径：`/api/forum/postTopicComment.php`
* 访问方式：`POST`
* 访问条件限制：登录后、有权在本板块回帖的用户

#### POST 请求格式：`JSON`
与回帖接口类似，此处略

#### POST 返回格式：`JSON`
与发帖接口类似，此处略

### 修改帖子接口
* URL路由访问地址：`/api/t/{Category}/{TopicID}`
* 文件实际路径：`/api/forum/putTopic.php`
* 访问方式：`PUT`
* 访问条件限制：楼主、管理员

#### PUT 请求格式：`JSON`
请求格式同发帖接口，此处略。

#### PUT 返回格式：`JSON`
返回格式同发帖接口，此处略。

### 修改回帖接口
* URL路由访问地址：`/api/t/{Category}/{TopicID}/{ReplyID}`
* 文件实际路径：`/api/forum/putTopicReply.php`
* 访问方式：`PUT`
* 访问条件限制：层主、管理员

#### PUT 请求格式：`JSON`
请求格式同发帖接口，此处略。

#### PUT 返回格式：`JSON`
返回格式同发帖接口，此处略。

### 删除帖子接口
* URL路由访问地址：`/api/t/{Category}/{TopicID}`
* 文件实际路径：`/api/forum/deleteTopic.php`
* 访问方式：`DELETE`
* 访问条件限制：楼主、管理员

#### DELETE 请求格式：`JSON`
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
* URL路由访问地址：`/api/t/{Category}/{TopicID}/{ReplyID}`
* 文件实际路径：`/api/forum/deleteTopicReply.php`
* 访问方式：`DELETE`
* 访问条件限制：层主、管理员

#### DELETE 请求格式：`JSON`
请求格式同删帖接口，此处略。

#### DELETE 返回格式：`JSON`
返回格式同删帖接口，此处略。


### 删除评论接口
* URL路由访问地址：`/api/t/{Category}/{TopicID}/{ReplyID}/{CommentID}`
* 文件实际路径：`/api/forum/deleteTopicComment.php`
* 访问方式：`DELETE`
* 访问条件限制：评论主、管理员

#### DELETE 请求格式：`JSON`
请求格式同删帖接口，此处略。

#### DELETE 返回格式：`JSON`
返回格式同删帖接口，此处略。


