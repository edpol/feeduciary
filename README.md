# Feeduciary setup

## Install

1. git clone
2. composer install
3. edit \laravel\database\seeds\UsersTableSeeder.php
   change administrator email and administrator password
4. php artisan migrate
5. php artisan db:seed 

## use

Not only can the Administrator enter Advisors, but anyone can enter their own information.

Entries by the Administrators are available for users to claim in the /advisors page.

Due to the complexity of the Fee calculations I decided to hardcode the  formulas in the AdvisorController. 
