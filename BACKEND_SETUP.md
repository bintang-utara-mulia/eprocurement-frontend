# Backend setup

Backend ini sudah API-only dan tidak membutuhkan Node.js/npm.

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
php artisan storage:link
php artisan serve
```

Health check: `GET http://127.0.0.1:8000/api/health`.
