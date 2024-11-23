FROM php:8.4.1-fpm-alpine

RUN apk add --no-cache \
    nginx \
    linux-headers \
    build-base \
    autoconf \
    curl \
    libzip-dev

RUN docker-php-ext-install zip

RUN pecl install redis && docker-php-ext-enable redis

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY docker/nginx/nginx.conf /etc/nginx/nginx.conf
COPY docker/nginx/default.conf /etc/nginx/http.d/default.conf

RUN mkdir -p /run/nginx

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage

EXPOSE 80

CMD sh -c "nginx && php-fpm"
