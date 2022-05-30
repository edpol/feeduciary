# Feeduciary setup

## Install

1. git clone
2. edit \laravel\database\seeds\UsersTableSeeder.php  
   change administrator email and administrator password
3. composer install *(creates vendor folder)*
4. php artisan migrate
5. php artisan db:seed 

### For Docker
ps aux - shows that www-data is the user running web service  
docker exec -it feeedphp chown -R www-data storage  
docker exec -it feeedphp chown -R www-data bootstrap/cache  
docker exec -it feeedphp chmod -R 775 storage  
docker exec -it feeedphp chmod -R 775 bootstrap/cache  

## use

Not only can the Administrator enter Advisors, but anyone can enter their own information.

Entries by the Administrators are available for users to claim in the /advisors page.

Due to the complexity of the Fee calculations I decided to hardcode the formulas in the AdvisorController. 
