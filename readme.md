## AutoBuy 自动售卖系统

## 安装步骤

首先，将程序克隆到本地：

```
git clone https://github.com/Qsnh/AutoBuy.git
```

安装依赖：

```
composer install
```

复制 `.env` ：

```
cp .env.example .env
```

在 `.env` 环境中配置好数据库等信息。执行：

```
php artisan key:generate
```

设置 `storage` 目录权限：

```
sudo chmod -R 0777 storage
```

安装数据库表：

```
php artisan migrate
```

填充默认数据：

```
php artisan db:seed
```

到这里安装结束。
  
后台地址：http://domain.app/home  
账号：auto_buy@admin.com  
密码：admin123  

> 如果想要程序完整的运行，还需要进行下面的配置。

### 其它配置

#### 支付配置 

本套系统的支付解决方式来自这一篇文章：[基于有赞云的个人收款即时到帐实现方案](https://laravel-china.org/articles/7014/real-time-account-implementation-scheme-based-on-personal-receipts-with-praise-clouds),您在阅读了上面的文章之后，请配置下 `.env` 文件中的：

```
YOUZAN_CLIENT_ID=
YOUZAN_CLIENT_SECRET=
YOUZAN_KDT_ID=
```

#### 邮箱配置

请参考：[http://www.cnblogs.com/taotaoxixihaha/p/6650845.html](http://www.cnblogs.com/taotaoxixihaha/p/6650845.html)

#### 定时任务配置

请参考：[https://laravel.com/docs/5.5/scheduling](https://laravel.com/docs/5.5/scheduling)

## 帮助

#### 忘记管理员密码？

首先，在项目根目录打开命令行，输入下面命令：  

```
php artisan password:reset
```

按照提示输入新密码即可！  
