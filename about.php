1.AOP编程 ： 面向切面编程思想 (中间件，behavior)
    数据验证层
    异常处理层
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
    Directory : app作为根目录自动补全namespace
    调试：在页面点击debug，然后复制地址到postman
23. 业务写在model层
    业务层进一步分层(model->server)
    interface 松耦合
24.安装接口测试工具 PostMan
25.tp5 路由：(默认url_route_on 是混合模式)(url_route_must 强制开启路由)
    PATH_INFO
    混合模式(同一个方法，对其进行路由，pathinfo就会失效)
    强制使用路与模式
    路由(获取参数变量)三种方法：
        1.hello($name) 变量自动对应
        2.request对象
        3.input助手函数获取
25.5  参数校验层
    validate :1.独立验证，2.验证器
        1.$data = ['name'=>'aqie']; $validate =new Validate([]); $result = $validate->banch()->check($data);
        2.验证器：
            1.api/validate/TestValidate 测试验证器   $validate =new TestValidate;
            2.

26.构建REST API (表述性状态转移)
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
    SOAP (Simple Object Access Protocol) xml表述数据
27.异常处理层
    a.异常的分类
        1.用户行为导致异常（没通过验证器,没查询到结果）继承BaseException类
            不需要记录日志，向用户返回具体信息
        2.服务器自身异常（代码错误,调用接口异常）
            记录日志，不向客户端返回具体原因
    b.'app_debug'              => false,  关闭调试模式
    c.lib/exception 有异常处理类
        'exception_handle'       => 'app\lib\exception\ExceptionHandler', 重新配置全局异常处理类
        ExceptionHandler :重写render方法
        BaseValidate     : gocheck(进行参数校验)
        客户端传递不符合要求id号：debug:错误页面,生产环境：500   都不符合要求
        应该使用自定义异常 ParameterException,并在BaseException编写构造函数
28.tp5日志
    1.config 配置 log,同时在index.php配置新路径
    2.关闭tp5日志 file->test，然后再要生成日志地方初始化日志
29.tp5查询数据库
    1.原生sql语句
    2.构造器查询数据库
    3.模型 关联模型操作数据
30.tp5连接数据库
    1.Db->Collection(实例化对象连接数据库)
        Db::辅助方法->
        query查询器(curd简单封装)
        原生sql
        ORM模型
    2.驱动提供不同类（F:\applet\thinkphp\library\think\db）
    3.前面是辅助方法(链式方法)后面是查询方法。 不执行select find update delete insert不会执行sql语句
        前面返回的是对象
31.
    1.开启sql数据库调试
     入口文件初始化日志配置
    2.
        ORM （object relation mapping 对象关系映射）
        模型关联 ()
        Db是model基础
        DB返回的是数组，模型返回的是对象
        业务简单，一个模型对应一张表（默认数据表名和模型名一一对应）
        自动生成模型：
            根目录(applet) php think make:model api/BannerItem   创建bannerItem模型
        a. 查询总结
            get find 只能查询一条记录,  get all 模型特有， find select db特有 ，但是模型也可以使用
            all select 返回一组
    3.关联模型  ($banner = self::with(["items",'items.img'])->find($id);)
        banner->banner_item 一对多
        banner_item->image 一对一
        嵌套关联
    4. http://z.cn/api/v1/banner/1   获取banner id为1的数据
        模型里隐藏 $protected
    5.note: 默认情况，数据表名和类名一一对应
32.查找错误
    1.
33.application/extra : setting.php 配置image路径
34. banner接口实现完成
    1.Banner图片路径：模型读取器，Image模型定义方法
    2.修改了MissException类
    3.创建了BaseModel
    4.多版本支持
        a.业务变更，不再根据id获取,通常根据传入版本号执行不同代码
            缺点：不利于单元测试,代码冗余
        b.开闭原则：扩展是开放的，修改是封闭的
35.主题接口（theme,theme_product）
   1. theme->product 多对多 需要第三张表中转theme_product
   2. 命令行创建控制器类   php think make:controller api/v1/Theme
    3.Theme->image 一对一
    4.编写验证器 IDCollection
    5.模型关联，在模型编写相关函数，在控制器调用模型使用with方法
    6.数据异常，抛出自定义异常
    7,在详情页时候，路由设置完整匹配
    8.字段冗余 main_imgh_url和img_id
    9.restful 基于资源，数据以模型方式返回
36.Product控制器 (获取最新商品)
    1.新建验证器count  （记得引入类）
    2.临时隐藏summary字段
    3.database 中配置，自动返回数据集 'resultset_type'  => 'collection',
        http://applet.com/api/v1/theme?ids=4,6,5  会返回空数组
        a.theme/getSimpleList
        b.product/getRecent  没有查询的话，不能用isEmpty（）

37.mysql
    1.时间戳
        select FROM_UNIXTIME(1501744530);
        Select UNIX_TIMESTAMP('2017-8-3 15:15:30');
38.分类(分类头图，分类商品信息) 新建category模型
39.基础数据分层(概念)
40.获取分类下的产品
    1.getAllInCategory()    验证类和异常类记得引入
41.API权限访问
    1.api中用户获取令牌
        客户端->(账号密码)->getToken(接口)
        a.是否合法,在有效期，有权限
        b.openid 用户唯一标识
        c.Token和用户信息存储在缓存中，加快访问速度
    2.新建Token接口  （use承载模型，token模型生成令牌）
        a.新建TokenGet验证器
        b.创建user模型类
        c.创建service层，在model层之上,model调用数据库访问层
        d.获取token
            小程序（code）->getToken
        e.extra/wx.php  微信配置项
        f.  APPID:  wxf293e83a91ef798d
            AppSecret(小程序密钥): b0e9abd300e9864f218bc616b2e0eb50
        g.application/common 公共文件可直接调用
        h.创建 WeChatException
        i:json 双引号
        k: 数据库插入 直接调用create方法
        l:service/Token.php 基类
            生成令牌
42.商品根据id查询
    1.商品详情  ：product_image img_id关联image表
    2. product -> product_image 一对多
    3. 现在product模型中写关联img和properties模型函数，然后再控制器中调用
    4. product_image ->image 一对一关系
    5.tp5路由顺序匹配 id 必须是整数
    6.  with()既可以用字符串，也可以用数组
        Banner模型getBannerById模型嵌套
43.地址管理接口 (新增保存数据接口 | 特定用户可以访问，需要保护)
    访问受保护接口，必须携带令牌 (课程9-9)  (BaseValidate 重点看下)
    1.新建Address控制器
    2.新建AddressNew验证器
    3.在Token编写根据Token获取
    4.新建userException
    5.查询接口  ，
    6.新建SuccessMessage异常类
    7.令牌+客户端提交过来地址 (createOrUpdateAddress)
44.令牌对用户分组，判断权限
    1.前置方法
    2.call_user_func — 把第一个参数作为回调函数调用 可以调用类中方法
    3,通过前置方法，利用scope作用域,如果小于16就中断作用域
    4.  新建BaseController
        Address 控制器，新建ForbiddenException,在基类控制器调用Token checkPrimaryScope()
        判断Token是否合法
45.订单接口 (OrderController)
    1.创建订单
        a.检测库存
        b.订单支付
    2.新建OrderPlace验证器
    3.在service新建Order模型
        1.新建OrderException
        2.在model新建Order模型
        3.Project Settings > Inspections > PHP > Undefined > Undefined field
        4.model新建OrderProduct模型
        5.10-10 10-11反了  snapOrder(方法重写) 10-12 和10-10重复   10-15 10-16重的
        6.一对多模型，先保存一再保存多
        7. createOrderByTrans(加入事物)
46.WebSocket
47.自动写入
48.支付
    1.新建Pay 控制器
    2.新建service/Pay模型
    3.https://pay.weixin.qq.com/wiki/doc/api/wxa/wxa_api.php?chapter=9_1 (统一下单)
    4.用户访问接口携带令牌，就能拿到用户openid
    5.如何从pay调用order (getProductStatus)
    6.在service/order 创建checkOrderStock(在service/pay模型调用) 10-20
        通过orderID拿到oProducts数据->(根据order_id 在order_products)表中查询出数据
    7.在service/Token 新建isValidOperate()
    8.lib/enum 创建配置文件
    9.微信预订单生成
    10.调用微信sdk
        1.extend/WxPay目录
        2.Loader::import(子文件.文件名，类所在目录，后缀名); 加载第三方类库
        3.WxPay.Data.php :统一下单
        4.  curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,TRUE);
            curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,2);//严格校验  WxPay.Api.php 改为false
        5.如果没有填写商户号MCHID
    11. 微信支付 服务端：调用统一下单接口
                 客户端 ： 调用微信支付API 通过服务器解析 wxOrder返回给小程序参数
    12.签名：防止参数篡改
            比对客户端传来签名，和微信自己算签名
    13. 支付->下单->预订单 服务器返回参数 -> 调用小程序支付接口 ->小程序向微信发起支付
    14.新建类service/WxNotify继承WxPayNotify
        1.链式方法 lock 查询锁    (悲观锁，乐观锁)
    15.Ngrok 反向代理
       extra\secure.php  配置路径
    16.下单接口，支付接口，微信回调接口
        1.测试pay/Notify  报错：未定义数组索引 HTTP_RAW_POST_DATA
            支付接口：order表状态会变；product表库存会变
47.订单列表
    1.Order 控制器下 getSummaryByUser()
        新增PagingParameter验证器
        Order模型内部新建 getSummaryByUser()
48.订单详情
    1.model/Order模型中定义读取器，来格式化显示数据 (snap_items,snap_address)
    2.
二：小程序
    a.处理服务器传递过来数据
    b.
三：服务器接口补充
    a.v1/Token 新建


四： CMS
    1.创建cms