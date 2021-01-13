# LineBot

# 遇到的ERROR處理辦法及重要筆記

## Log could not be opened: failed to open stream: Permission denied 解決方法
*  chown laradock:laradock ./storage -R

## Request Message array 格式

## LINE Message 格式
```
 array (
  'events' =>
  array (
    0 =>
    array (
      'type' => 'message',
      'replyToken' => 'd439xxxxxxx1fc48',
      'source' =>
      array (
        'userId' => 'xxxx',
        'type' => 'user',
      ),
      'timestamp' => 1565081621327,
      'message' =>
      array (
        'type' => 'text',
        'id' => '10343775297084',
        'text' => 'hi kejyun line bot',
      ),
    ),
  ),
  'destination' => 'Ued2b13xxxxxx804b',
)
```

## Laradock Supervistor設置
寫好了工作隊列之後要交給系統去監聽Redis中有無要執行的工作事項
Laradocker則是使用php-worker中的Supervistor來查看專案的隊列進程

### 1.更改Laradock中PHP_WORKER_INSTALL_[Database]的參數，可以依照自己使用的DB去更改相對應的參數:
這邊用Redis，所以用
PHP_WORKER_INSTALL_REDIS=true
### 2.build一個php-worker容器:
```sh
docker-compose build php-worker
```
### 3.Laradock/php-worker/supervistor.d中將laradock-worker.conf.example複製成laradock-worker.conf
然後修改其中的command參數指定到要下Artisan指令中的專案路徑:
```sh
command=php /var/www/[project_path]/artisan queue:work --sleep=3 --tries=3 --daemon
```
### 4.修改後將容器啟用，可以用docker-compose ps查看status是否有正常啟動，啟用後可以使用指令查看隊列處理狀態及目前效能使用率:
```sh
 docker-compose up -d php-worker //將php-worker容器啟動

docker-compose ps
           Name                          Command               State                                                 Ports
------------------------------------------------------------------------------------------------------------------------------------------------------------------------
laradock_docker-in-docker_1   dockerd-entrypoint.sh            Up      2375/tcp, 2376/tcp
laradock_mysql_1              docker-entrypoint.sh mysqld      Up      0.0.0.0:3306->3306/tcp, 33060/tcp
laradock_nginx_1              /docker-entrypoint.sh /bin ...   Up      0.0.0.0:443->443/tcp, 0.0.0.0:80->80/tcp, 0.0.0.0:81->81/tcp
laradock_php-fpm_1            docker-php-entrypoint php-fpm    Up      9000/tcp
laradock_php-worker_1         /usr/bin/supervisord -n -c ...   Up
laradock_phpmyadmin_1         /docker-entrypoint.sh apac ...   Up      0.0.0.0:8081->80/tcp
laradock_redis_1              docker-entrypoint.sh redis ...   Up      0.0.0.0:6379->6379/tcp
laradock_workspace_1          /sbin/my_init                    Up      0.0.0.0:2222->22/tcp, 0.0.0.0:3000->3000/tcp, 0.0.0.0:3001->3001/tcp, 0.0.0.0:4200->4200/tcp,
                                                                       0.0.0.0:8001->8000/tcp, 0.0.0.0:8080->8080/tcp
                                                                       
docker exec -it laradock_php-worker_1 top //查看處理狀態
  376     1 root     S    49292   1%   0   0% php /var/www/artisan queue:work redis --sleep=3 --tries=3 --daemon
  375     1 root     S    47244   1%   0   0% php /var/www/artisan queue:work redis --sleep=3 --tries=3 --daemon
    1     0 root     S    24396   0%   0   0% {supervisord} /usr/bin/python3 /usr/bin/supervisord -n -c /etc/supervisord.conf
  369     1 root     S    49292   1%   0   0% php /var/www/artisan queue:work redis --sleep=3 --tries=3 --daemon
  374     1 root     S    47244   1%   0   0% php /var/www/artisan queue:work redis --sleep=3 --tries=3 --daemon
  372     1 root     S    47244   1%   0   0% php /var/www/artisan queue:work redis --sleep=3 --tries=3 --daemon
  371     1 root     S    47244   1%   0   0% php /var/www/artisan queue:work redis --sleep=3 --tries=3 --daemon
  370     1 root     S    47244   1%   0   0% php /var/www/artisan queue:work redis --sleep=3 --tries=3 --daemon
  373     1 root     S    47244   1%   0   0% php /var/www/artisan queue:work redis --sleep=3 --tries=3 --daemon
  425     0 root     S     1576   0%   1   0% top
  431     0 root     R     1576   0%   1   0% top

```
