# koFast

koFast 是一个在 kohana(koseven) 的基础上扩展的一个快速开发项目模板

# 初衷

Kohana 是一款纯 PHP5 的框架，基于 MVC 模式开发，它的特点就是高安全性，轻量级代码，容易使用。目前新的 koseven
框架已经完美支持 php7。我个人开发的项目基本都是基于此框架，在使用框架的过程中，总结并扩展了许多的功能，是得开发
项目更加快速、高效。

# 代码分层架构

- Controller     控制器层，用于处理数据输入和输出
- Service        服务层
    - Business   业务逻辑层，业务逻辑的封装
    - Dao        数据连接层，对数据库数据的具体操作
    - Model      数据对象层，数据库数据转化成的实体对象
- View           视图层，负责数据的渲染和显示

# 目录简介
- app  应用
- service 服务
  - Business 业务逻辑
  - Dao 数据连接操作
  - Model 数据实体
- doc   文档
- kofast/koseven 框架(不包括 extends)
- kofast/extends koseven 扩展模块
- public 访问入口

## 思考

service 目录单独提出来与 app 同级的考虑，如果开发多个应用，例如 app1(管理后台), app2(接口项目) 往往会复用业务逻辑，只需要在 bootstrap.php 加载 SERPATH 模块即可

app 里只需要专注于 controller 的输入输出处理即可

# 扩展功能与特性

- 合理的代码分层架构
- 实现登录示例
- 控制器基类封装
- 增加验证码模块
- 增加日志模块
- 增加 ueditor 模块
- 增加数据访问 dao 模块
- 增加数据库分表分库模块
- 增加异常日志到数据功能
- 增加 session 存储到 memcache redis功能

# 登录页面示例预览
![image](https://github.com/phachon/kofast/blob/master/doc/img/kofast-login.png)

# 安装使用
下载： https://github.com/phachon/kofast

# 问题反馈
在使用中有任何问题，请联系 phachon@163.com

## License

MIT

Thanks
---------
Create By phachon@163.com