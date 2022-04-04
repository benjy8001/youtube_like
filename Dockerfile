FROM php:8.0-apache

RUN apt-get install -y $PHPIZE_DEPS && \
    pecl install xdebug && \
    docker-php-ext-enable xdebug && \
    docker-php-ext-install mysqli pdo pdo_mysql gd && \
    a2enmod rewrite && \
    apt-get remove -y $PHPIZE_DEPS

RUN set -eux; \
	apt-get update; \
	apt-get install -y gosu; \
	rm -rf /var/lib/apt/lists/*; \
    addgroup bar; \
    adduser -D -h /home -s /bin/sh -G bar foo

WORKDIR /var/www/
#RUN unlink /etc/apache2/sites-enabled/000-default.conf

#COPY ./docker/vhost.d /etc/apache2/sites-enabled/000-default.conf
