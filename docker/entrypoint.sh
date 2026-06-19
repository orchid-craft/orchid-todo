#!/usr/bin/env bash
set -euo pipefail

export PORT="${PORT:-10000}"

if [[ -n "${DATABASE_URL:-}" && -z "${DB_URL:-}" ]]; then
    export DB_URL="${DATABASE_URL}"
fi

if [[ -n "${RENDER_EXTERNAL_URL:-}" && -z "${APP_URL:-}" ]]; then
    export APP_URL="${RENDER_EXTERNAL_URL}"
fi

sed -ri "s/^Listen .*/Listen ${PORT}/" /etc/apache2/ports.conf
sed -ri "s/<VirtualHost \*:.*>/<VirtualHost *:${PORT}>/" /etc/apache2/sites-available/000-default.conf

php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan storage:link --force || true

if [[ "${RUN_MIGRATIONS:-true}" == "true" ]]; then
    php artisan migrate --force
fi

php artisan config:cache
php artisan view:cache

exec "$@"
