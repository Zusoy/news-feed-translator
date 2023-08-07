FROM php:8.1-fpm as base

RUN docker-php-ext-install pdo_mysql

RUN pecl install apcu

RUN apt-get update && \
    apt-get install -y \
    libzip-dev

RUN docker-php-ext-install zip
RUN docker-php-ext-enable apcu

WORKDIR /usr/src/app

RUN PATH=$PATH:/usr/src/app/vendor/bin:bin
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
