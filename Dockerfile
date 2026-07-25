FROM php:8.2-fpm

# Install system deps + PHP extensions
RUN apt-get update && apt-get install -y \
    libpq-dev libzip-dev unzip git nginx \
    && docker-php-ext-install pdo pdo_pgsql zip

# PHP upload/runtime settings
RUN echo "upload_max_filesize=20M" > /usr/local/etc/php/conf.d/uploads.ini \
    && echo "post_max_size=25M" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "memory_limit=256M" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "max_execution_time=120" >> /usr/local/etc/php/conf.d/uploads.ini

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

RUN mkdir -p storage/framework/sessions storage/framework/views storage/framework/cache storage/framework/testing storage/logs bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

RUN composer install --optimize-autoloader --no-dev --no-interaction

# Nginx config
COPY nginx.conf /etc/nginx/sites-available/default

EXPOSE 10000

CMD php artisan storage:link && \
    php artisan migrate --force && \
    php artisan config:cache && \
    service nginx start && \
    php-fpm