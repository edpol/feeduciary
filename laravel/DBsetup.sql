create database feeduciary17;

GRANT ALL PRIVILEGES ON feeduciary17.* TO 'advisor17'@'localhost' IDENTIFIED BY "madmax2017!";

FLUSH PRIVILEGES;

--  php artisan migrate:refresh --seed

-- give write access to the webserver user
-- C:\inetpub\wwwroot\feeduciary\laravel\storage/logs/laravel.log"
-- C:\inetpub\wwwroot\feeduciary\laravel\storage\framework/sessions
-- C:\inetpub\wwwroot\feeduciary\laravel\storage\framework/views