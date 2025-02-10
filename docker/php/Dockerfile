FROM php:7.3-fpm

# Cài đặt các package cần thiết
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    locales \
    libonig-dev \
    libzip-dev \
    mariadb-client \
    && docker-php-ext-install pdo pdo_mysql mysqli

# Cài đặt Composer
RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer

WORKDIR /var/www/html
