1.AOP编程 ： 面向切面编程思想 (中间件，behavior)
2.ThinkPHP 5 +MySQL
3.客户端向服务端请求数据，完成自身逻辑
4.CMS 向服务端请求数据，实现发货与发送微信消息
5.三端分离 (服务端,客户端,数据分离)
6.Token令牌管理权限
7.适配(iOS,Android,小程序,单页面)

8.Web框架核心(路由，控制器，模型)
    tp5:路由，获取http参数,数据库操作
9.验证器，读取器，缓存与全局异常处理

10. ORM框架 (Object Relational Mapping) 模型与关联模型
    sequelize(node框架)
    SQLAlchemy(python)
    IE Framework(微软)
11.微信小程序
12.API接口由路由定义的
13.验证器(数据验证)，读取器，缓存，全局异常处理
14.微信登录
15.微信支付(预订单,支付,回调通知处理)
16.mysql
    数据表设计
    数据冗余合理利用
    事务与锁在订单(库存量)检测中应用
17.web矩阵 ： 网站，ios,Android,微信(h5,公众号),小程序
18.依赖或者包管理 ：composer npm pip
19.开发工具：
    PHPStorm (微信开发者工具)VS Code  PostMan(Fiddler)(接口测试) (单元测试)
20.Nginx反向代理
21.服务器程序：applet
    客户端小程序： Protoss
    CMS : Terran
22. PS 快捷键 (优雅使用ps：http://www.tuicool.com/articles/JzqumuR)
    ctrl+E : 快速查找文件
    alt+箭头 : 切换文件
    快速搜索 ; ctrl+shif+n
    项目中查找 ; ctrl+shift+F   ctrl+f
    命令行运行 ： 进入public 目录 php -S localhost:8080 route.php
    ctrl +alt +o :删除无用命名空间
23. 业务写在model层
    业务层进一步分层(model->server)
24.安装接口测试工具 PostMan
25.tp5 路由：(默认url_route_on 是混合模式)(url_route_must 强制开启路由)
    PATH_INFO
    混合模式
    强制使用路与模式
26.构建REST API
    1.轻
    2.Json描述数据
    3.无状态
    4.基于资源，增删改查针对资源状态改变
    5.使用HTTP动词操作资源 （url表示资源）
    6. /getmovie/:mid (不推荐)
        GET： /movie/:mid
    7.RESTFul API 实践
        HTTP动词（幂等性，资源安全性）（POST:创建 PUT:更新 GET:查询 DELETE:删除）
    8.统一描述错误(错误码,错误信息,当前URL)
        400：参数校验不通过 201：资源创建POST成功 202：资源PUT成功 401：未授权，无权限
        403：资源被禁止 500：服务器未知错误
        错误码：自定义的错误id号
    9.Token令牌授权验证身份
        版本控制
        测试生产环境分开 api.xxx.com
                        dev.api.xxx.com
    10.URL语义明确，有标准文档
    11.RESTFul API : 1.豆瓣开放API  (https://developers.douban.com/wiki/?title=api_v2)
                     2.github API  (https://developer.github.com/v3/)
    REST (Representational State Transfer 表述性状态转移)
    SOAP (Simple Object Access Protocol)
27.异常的分类
    1.用户行为导致异常（没通过验证器,没查询到结果）
        不需要记录日志，向用户返回具体信息
    2.服务器自身异常（代码错误,调用接口异常）
        记录日志，不向客户端返回具体原因
28.tp5日志
    1.config 配置
    2.关闭tp5日志 file->test，然后再要生成日志地方初始化日志
