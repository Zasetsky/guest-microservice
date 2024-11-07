FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
	git \
	libpq-dev \
	zip unzip \
	&& docker-php-ext-install pdo pdo_pgsql bcmath

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

COPY . .

RUN php artisan key:generate
