 Laravel Posts API & Admin Panel (Sail + Docker)

Overview
This Laravel application includes:
- **JWT  authentication**
- **Admin Panel** (CRUD for Users & Posts)
- **API for retrieving posts** with pagination, sorting, and truncated descriptions
- **Post creation** with title, description (max 2KB), and phone number
- **Laravel Telescope** to log all actions and errors
- **Real-time notifications** to admin when new posts are created (bonus)
- **Custom install command**: `sail artisan install:project <name>`

---

##  Requirements
- **Docker** & **Docker Compose**
- **Composer** (for initial setup)
- **Git**
- **Node.js & NPM** (for building AdminLTE assets)

---

##  Installation (Laravel Sail)

### 1️⃣ Clone the repository
git clone [https://github.com/yourusername/laravel-posts-api.git](https://github.com/alinweshi/blog-app)
cd blog-app
2️⃣ Install PHP dependencies
composer install
3️⃣ Create environment file
cp .env.example .env
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:vkJudPQfAxfdynIP54HTKCBy8a19xQE3a0n3QkFPyuE=
APP_DEBUG=true
APP_URL=http://localhost

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

APP_MAINTENANCE_DRIVER=file
# APP_MAINTENANCE_STORE=database

PHP_CLI_SERVER_WORKERS=4

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=blog-app
DB_USERNAME=sail
DB_PASSWORD=password

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=pusher
FILESYSTEM_DISK=local
QUEUE_CONNECTION=redis

CACHE_STORE=database
# CACHE_PREFIX=

MEMCACHED_HOST=127.0.0.1

REDIS_CLIENT=phpredis
REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=log
MAIL_SCHEME=null
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

VITE_APP_NAME="${APP_NAME}"
VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
VITE_PUSHER_HOST="${PUSHER_HOST}"
VITE_PUSHER_PORT="${PUSHER_PORT}"
VITE_PUSHER_SCHEME="${PUSHER_SCHEME}"

PUSHER_APP_ID=2033015
PUSHER_APP_KEY=4c9dbacc841202cb4711
PUSHER_APP_SECRET=227ce715224b7a6f7d56
PUSHER_APP_CLUSTER=mt1
PUSHER_HOST=

PUSHER_PORT=443
PUSHER_SCHEME=https

JWT_SECRET=l16IzBYdHOWCqw6RSfPHElewspYuxjZArXrWjyiefbYkvUkv3jw8AXgX5wuZfBiJ

4️⃣ Start Sail containers
bash
Copy
Edit
./vendor/bin/sail up -d
./vendor/bin/sail artisan install:project blog-app
This will:

Run migrations & seeders

Install JWT or Passport keys

Publish Laravel Telescope config

Publish AdminLTE assets

Create a default admin and user:


