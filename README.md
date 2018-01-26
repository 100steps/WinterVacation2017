# 2017级寒假作业
**大家的寒假作业就用这个仓库来管理吧~**  

## 操作说明
1. 每个小组的不同方向按照 `小组名-任务内容-方向` 的格式（英文）建立新分支，例如 `saltfish-tieba-backend`  
2. 如果写了文档或者有其他相关资源文件如流程图什么的需要共享可以建立分支，命名为 `doc`，如 `saltfish-tieba-doc`
3. 每个分支下至少有个 `readme` 用中文说明一下这个分支的内容
3. 尽量多 `push`，`commit` 信息要概括性稍微强一些，要表达有用的信息
4. 因为最初远端只有这个主分支，所以创建新分支之后要手动将本地新分支推到远端，详情见下方说明
5. 如果发现在推的时候被服务器拒绝（原因是无权限而不是因为 commit 冲突），可能是由于某些神奇的原因导致你没有被加进有这个仓库写入权限的 team，请联系 401 处理。

## git 操作说明
```shell
# 克隆本仓库
git clone git@github.com:100steps/WinterVacation2017.git
# 进入项目文件夹
cd WinterVacation2017

############## 需要建立一个空白的新分支时：##############
# 建立一个不基于任何 commit 的新分支
git checkout --orphan 分支名
# 删除本目录下的所有文件以获得清爽的工作目录
rm -f ./*
#### 开始工作 ####

############# 推送本地的新分支到远端 #############
git push -u origin 分支名:分支名
```
