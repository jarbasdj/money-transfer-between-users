FROM php:8-fpm

ENV DEBIAN_FRONTEND noninteractive

LABEL maintainer="Jarbas Santos <jarbas.santos.0409@gmail.com>"

# Update SO package manager
RUN apt-get update \
    && apt-get install libzip-dev zip unzip iputils-ping -y \
    && pecl install xdebug redis timezonedb redis \
    && docker-php-ext-install zip pdo_mysql \
    && docker-php-ext-enable redis

# Copy .ini files
COPY *.ini /usr/local/etc/php/conf.d/

# Install composer on container
RUN curl https://getcomposer.org/composer-stable.phar -o /usr/local/bin/composer \
    && chmod +x /usr/local/bin/composer 

WORKDIR /var/www/app