##官卖交易管理后台

### 部署文档
```text
git clone -b develop https://github.com/onemena/quora-arab.git
 
chmod -R 777 storage
 
chmod -R 777 bootstrap
 
cp .env.example  .env
    
#修改.env数据库配置文件
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=game_sdk
DB_USERNAME=root
DB_PASSWORD=root
    
DB_LOG_CONNECTION=mysql
DB_LOG_HOST=127.0.0.1
DB_LOG_PORT=3306
DB_LOG_DATABASE=game_sdk_log
DB_LOG_USERNAME=root
DB_LOG_PASSWORD=root

    
#支持redis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379    
```
### 安装第三方控件
```text
composer install

```

### 单独安装日志系统
```text
php artisan log-viewer:publish
 
php artisan log-viewer:publish --force
 
php artisan log-viewer:publish --tag=config
 
php artisan log-viewer:publish --tag=lang
 
php artisan log-viewer:check

```

### 表迁移
```text
php artisan migrate
    
php artisan db:seed --class=DatabaseSeeder


```


###(完毕)
