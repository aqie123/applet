1.app接口(通信接口)->请求接口地址->返回接口数据->解析数据
2.通信接口：
    接口地址
    接口文件(处理业务逻辑)
    接口数据
3.缓存技术
  Memcache Redis 存储在内存
  Memcache 简单key/value
  Redis
4.定时任务
crontab
*/1****php /data/www/cron.php   // 每分钟执行  (分钟,小时)
50 7 *** /sbin/service sshd start  // 每天7：50开启
5.App接口开发
    a.读取数据库开发首页接口(数据封装->接口数据) 数据时效性高系统
    b.读取缓存方式
    c.定时读取缓存方式