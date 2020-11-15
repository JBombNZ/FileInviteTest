# FileInviteTest

1. Clone repository
2. run 'composer install'
3. copy .env.example to .env
4. Edit .env and setup your database
4.1 You may need to add Sanctum stateful domain to .env depending on what domain name you are using. Example: SANCTUM_STATEFUL_DOMAINS="fileinvite.local"
5. Run php artisan migrate
6. Run php artisan db:seed
7. Navigate your browser to your web server, you can login as jeremy@likefury.com and 'password' as the password

