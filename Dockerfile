FROM php:8.3-cli

RUN apt-get update && apt-get install -y \
    unzip git curl libzip-dev libsqlite3-dev \
    && docker-php-ext-install zip pdo pdo_sqlite

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views storage/logs database bootstrap/cache

RUN touch database/database.sqlite

RUN chmod -R 775 storage bootstrap/cache database

RUN php artisan key:generate --force

RUN php artisan migrate --force || true

EXPOSE 10000

CMD php artisan serve --host=0.0.0.0 --port=${PORT:-10000}