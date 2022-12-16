## About
kakaphp基于laravel的后端与api框架实现, 因应前后端分离开发, 提供完整后端解决方案, 采用仓库服务设计模式, 
把数据处理逻辑分离使得代码更容易维护

## Feature
* 使用仓库服务设计模式
* 引用 tymon/jwt-auth 作用token认证机制
* API接口签名验证, 用对称加密
* 系统配置模块
* 权限模块
* 菜单模块
* websocket模块
* 文件上传与缩略图功能
* 数据导出功能实现
* 引用 mews/captcha 作为图片验证码
* redis原子锁
* 短信与邮件模块, 用 messagebird 第三方服务
* 提供国家/ip过滤器, 可设置白名单和黑名单
* logger日志模块优化, 存储 mongodb
* HttpRequest模块优化
* 报表统计模块, 自带用户在线、用户活跃、用户留存、用户增长
* 钱包模块
* 订单模块
* 子帐号模块

## Requires
PHP 7.4 or Higher  
Redis
MongoDB 3.2 or Higher

## Install
```
composer install
cp .env.example .env
php artisan app:install
php artisan storage:link
php artisan jwt:secret
```

## Usage
```
# Login Admin
username: admin
password: Bb123456
```

## Change Log
v1.0.0

## Maintainers
Alan

## LICENSE
[MIT License](https://github.com/joanbabyfet/kakaphp/blob/master/LICENSE)
