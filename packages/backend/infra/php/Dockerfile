FROM composer:2.5.4 as composer

FROM php:8.2-fpm-alpine as app-base

RUN apk add --no-cache mysql-client msmtp perl wget procps shadow libzip libpng libjpeg-turbo libwebp freetype icu tzdata

RUN apk add --no-cache --virtual build-essentials \
    icu-dev icu-libs zlib-dev g++ make automake autoconf libzip-dev \
    libpng-dev libwebp-dev libjpeg-turbo-dev freetype-dev unzip && \
    docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg --with-webp && \
    docker-php-ext-install gd && \
    docker-php-ext-install mysqli && \
    docker-php-ext-install pdo_mysql && \
    docker-php-ext-install intl && \
    docker-php-ext-install opcache && \
    docker-php-ext-install exif && \
    docker-php-ext-install zip && \
    docker-php-ext-install bcmath && \
    apk del build-essentials && rm -rf /usr/src/php*

ENV TZ=Asia/Tokyo \
    LANG=en_US.UTF-8 \
    LANGUAGE=en_US:en \
    LC_ALL=en_US.UTF-8

RUN cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini
COPY ./infra/php/settings/php.ini /usr/local/etc/php/conf.d/php.ini
ADD ./infra/php/settings/zz-docker.conf /usr/local/etc/php-fpm.d/zz-docker.conf

# Laravel Sail
ARG WWWGROUP
ARG WWWUSER
RUN groupadd --force -g $WWWGROUP sail
RUN useradd --no-user-group -m -g $WWWGROUP -u $WWWUSER sail
RUN sed -i "s/www-data/$WWWGROUP/g" /usr/local/etc/php-fpm.d/zz-docker.conf

RUN mkdir -p /var/run/php-fpm/ && chown sail:$WWWGROUP /var/run/php-fpm/

USER sail

COPY --from=composer /usr/bin/composer /usr/bin/composer

USER root
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
RUN apk add --no-cache --virtual .build-deps linux-headers autoconf gcc g++ make && \
    pecl install xdebug && \
    docker-php-ext-enable xdebug && \
    apk del .build-deps
USER sail

ARG WWWGROUP
ADD --chown=sail:$WWWGROUP ./infra/php/settings/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

ADD --chown=sail:$WWWGROUP ./composer.json ./
ADD --chown=sail:$WWWGROUP ./composer.lock ./
RUN composer install -n --no-ansi --no-scripts --no-progress --prefer-dist

ADD --chown=sail:$WWWGROUP ./ ./

RUN composer install -n --no-ansi --no-progress --prefer-dist && \
    chmod -R 777 storage bootstrap/cache && \
    php artisan clear-compiled && \
    php artisan config:clear && \
    php artisan route:clear && \
    php artisan view:clear && \
    php artisan optimize && \
    php artisan view:cache
