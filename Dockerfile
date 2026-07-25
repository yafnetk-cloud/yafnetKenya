FROM php:8.2-cli

# Install PHP extensions Laravel needs
RUN apt-get update && apt-get install -y \
    libpq-dev libzip-dev unzip git \
    && docker-php-ext-install pdo pdo_pgsql zip

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

RUN composer install --optimize-autoloader --no-dev --no-interaction

EXPOSE 10000
CMD php artisan migrate --force && php artisan config:cache && php artisan serve --host 0.0.0.0 --port $PORT