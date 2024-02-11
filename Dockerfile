FROM php:8.0-fpm-alpine

# Install dependencies required for Composer
RUN apk update && apk add \
    zlib-dev \
    libzip-dev \
    unzip \
    $PHPIZE_DEPS \
    linux-headers

# Install Xdebug
RUN pecl install xdebug && docker-php-ext-enable xdebug

# Set XDEBUG_MODE environment variable
ENV XDEBUG_MODE=coverage

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY ./php /php
WORKDIR /php

# Install PHP dependencies
RUN composer install
