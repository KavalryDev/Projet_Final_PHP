FROM php:7.4-apache

RUN docker-php-ext-install mysqli pdo pdo_mysql json \
&& a2enmod rewrite \

FROM composer as composer
COPY . /app
RUN composer install --ignore-platform-reqs --no-scripts

FROM php:fpm
WORKDIR /var/www/root/
RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng12-dev \
        zip \
        unzip \
    && docker-php-ext-install -j$(nproc) iconv mcrypt \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install mysqli \
    && docker-php-ext-enable opcache
COPY . /var/www/root
COPY --from=composer /app/vendor /var/www/root/vendor