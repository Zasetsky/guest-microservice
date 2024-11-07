FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
	git \
	libpq-dev \
	zip unzip \
	&& docker-php-ext-install pdo pdo_pgsql bcmath

# Установка Composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader

# Генерация ключа приложения
RUN php artisan key:generate
