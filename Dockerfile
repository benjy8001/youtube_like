FROM php:8.0-apache

RUN apt-get update && \
    apt-get install -y $PHPIZE_DEPS libjpeg-dev libpng-dev zlib1g-dev libonig-dev libzip-dev libfreetype6-dev && \
    pecl install xdebug && \
    docker-php-ext-enable xdebug && \
    docker-php-ext-configure gd --with-jpeg --with-freetype && \
    docker-php-ext-install mysqli pdo pdo_mysql mbstring zip gd && \
    a2enmod rewrite && \
    apt-get remove -y $PHPIZE_DEPS

RUN set -eux; \
	apt-get install -y gosu; \
	rm -rf /var/lib/apt/lists/*; \
    addgroup bar; \
    adduser -D -h /home -s /bin/sh -G bar foo

WORKDIR /var/www/
#RUN unlink /etc/apache2/sites-enabled/000-default.conf

#COPY ./docker/vhost.d /etc/apache2/sites-enabled/000-default.conf
