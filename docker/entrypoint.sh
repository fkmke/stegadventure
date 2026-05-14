#!/usr/bin/env bash
set -euo pipefail
cd /var/www

mkdir -p storage/framework/{cache/data,sessions,views,testing} storage/logs bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache 2>/dev/null || true

# Only generate APP_KEY when nothing else supplied one. In k8s APP_KEY comes
# from a Secret, so this branch is skipped — pods stay key-consistent.
if [ -z "${APP_KEY:-}" ] && ! grep -qE '^APP_KEY=base64:' .env 2>/dev/null; then
    [ -f .env ] || cp .env.example .env
    php artisan key:generate --force --no-interaction || true
fi

php artisan config:cache || true
php artisan route:cache  || true
php artisan view:cache   || true

exec "$@"
