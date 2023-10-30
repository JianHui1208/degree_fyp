cd C:\inetpub\wwwroot\Factory-Management-System
start composer dump-autoload
start php artisan migrate
start php artisan db:seed --class=PermissionsTableSeeder
start php artisan cache:clear
start php artisan route:clear
start php artisan config:clear 
start php artisan view:clear
exit