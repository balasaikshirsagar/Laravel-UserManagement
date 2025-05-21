1.Steps to Run the Project - 
2.git clone <repo-url>
3.cd <project-folder>
4.composer install
5.cp .env.example .env
6.php artisan key:generate
7.Set Up Database
8.php artisan migrate
9.npm install
10.npm run dev  # or "npm run build"
11.php artisan serve


.env - database configuration

APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:+Y4b0rGMM4BIsyJSz7Y+mb0psVmKiC7Q2iqZUqAcBss=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=user_management
DB_USERNAME=root
DB_PASSWORD=

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DRIVER=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=balasaikshirsagar@gmail.com
MAIL_PASSWORD=fjznhcfrzaynihxn
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=balasaikshirsagar@gmail.com
MAIL_FROM_NAME="${USER MANAGEMENT SYSTEM APPLICATION}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
![Screenshot 2025-05-22 003816](https://github.com/user-attachments/assets/3396a620-10cf-45a7-9f88-58d715783c97)
