# Build stage
FROM php:8.3-fpm-alpine AS builder
RUN apk add --no-cache git curl libpng-dev libzip-dev oniguruma-dev nodejs npm && \
    docker-php-ext-install pdo pdo_mysql zip
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/html
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --prefer-dist
COPY package.json package-lock.json ./
RUN npm ci
COPY . .
RUN npm run build

# Production stage
FROM php:8.3-fpm-alpine
RUN apk add --no-cache libpng libzip
WORKDIR /var/www/html
COPY --from=builder /var/www/html /var/www/html
COPY --from=builder /usr/local/etc/php/php.ini /usr/local/etc/php/php.ini
RUN php artisan storage:link || true
CMD php artisan migrate --force && php artisan config:cache && php-fpm
