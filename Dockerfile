# syntax=docker/dockerfile:1.7

# --- Stage 1: build frontend assets ---
FROM node:20-alpine AS assets
WORKDIR /app
COPY package.json package-lock.json vite.config.js ./
RUN npm ci
COPY resources ./resources
COPY public ./public
RUN npm run build

# --- Stage 2: install PHP dependencies ---
# Pin to the PHP version the lockfile requires. The official `composer:2`
# image ships an ever-newer PHP and breaks lockfile resolution.
FROM php:8.3-cli-alpine AS vendor
RUN apk add --no-cache git unzip libzip-dev \
    && docker-php-ext-install zip \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install \
        --no-dev --no-interaction --no-progress --no-scripts \
        --prefer-dist --optimize-autoloader

# --- Stage 3: runtime (nginx + php-fpm) ---
FROM php:8.3-fpm-alpine AS runtime

RUN apk add --no-cache \
        nginx supervisor bash tini \
        icu-dev libzip-dev oniguruma-dev \
        libpng-dev libjpeg-turbo-dev freetype-dev \
        libpq postgresql-dev \
        $PHPIZE_DEPS \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" \
        pdo_mysql pdo_pgsql \
        mbstring zip exif pcntl gd intl bcmath opcache \
    && apk del $PHPIZE_DEPS postgresql-dev \
    && rm -rf /var/cache/apk/*

WORKDIR /var/www

COPY . /var/www
COPY --from=vendor /app/vendor /var/www/vendor
COPY --from=assets /app/public/build /var/www/public/build

COPY docker/nginx.conf       /etc/nginx/nginx.conf
COPY docker/php-fpm.conf     /usr/local/etc/php-fpm.d/zz-app.conf
COPY docker/php.ini          /usr/local/etc/php/conf.d/zz-app.ini
COPY docker/supervisord.conf /etc/supervisord.conf
COPY docker/entrypoint.sh    /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

RUN chown -R www-data:www-data /var/www \
    && find /var/www/storage /var/www/bootstrap/cache -type d -exec chmod 775 {} \; \
    && find /var/www/storage /var/www/bootstrap/cache -type f -exec chmod 664 {} \;

EXPOSE 80
ENTRYPOINT ["/sbin/tini", "--", "/usr/local/bin/entrypoint.sh"]
CMD ["supervisord", "-c", "/etc/supervisord.conf"]
