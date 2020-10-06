FROM php:7.4-fpm

WORKDIR /var/www/

COPY . /var/www/

RUN usermod -u 1000 www-data && chown -R 1000:1000 /var/www