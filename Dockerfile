FROM php:8.1-apache

USER root

RUN apt-get update
RUN apt-get install -y libzip-dev zip libgmp-dev libssl-dev npm
RUN docker-php-ext-configure zip
RUN docker-php-ext-install zip gmp
RUN docker-php-ext-install -j$(nproc) mysqli pdo_mysql
RUN docker-php-ext-enable mysqli
# Install mongo
# RUN pecl install mongodb && echo "extension=mongodb.so" > /usr/local/etc/php/conf.d/ext-mongodb.ini

WORKDIR /app/
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN cp composer.phar /usr/local/bin/composer
RUN chmod +x /usr/local/bin/composer

ENV APACHE_DOCUMENT_ROOT /var/www/html/public
WORKDIR /var/www/html/
COPY . .
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN a2enmod rewrite
RUN composer update

RUN npm install && npm run dev
