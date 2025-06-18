#FROM php:8.2-fpm
#
#RUN apt-get update && \
#    apt-get install -y --no-install-recommends \
#    git curl unzip zip libzip-dev libpng-dev libonig-dev libxml2-dev \
#    libjpeg-dev libfreetype6-dev gnupg && \
#    curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
#    apt-get install -y nodejs && \
#    docker-php-ext-configure zip && \
#    docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath gd && \
#    apt-get clean && rm -rf /var/lib/apt/lists/*
#
#COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
#
#WORKDIR /var/www/html
#COPY . .
#RUN composer install
#
##RUN php artisan migrate && \
##    php artisan serve
#
#EXPOSE 9000



FROM php:8.2-apache

RUN apt-get update && \
    apt-get install -y --no-install-recommends \
    git curl unzip zip libzip-dev libpng-dev libonig-dev libxml2-dev \
    libjpeg-dev libfreetype6-dev gnupg && \
    curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs && \
    docker-php-ext-configure zip && \
    docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath gd && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN chown -R www-data:www-data storage bootstrap/cache
RUN a2enmod rewrite

# Fix MPM conflict
RUN a2dismod mpm_event mpm_worker && a2enmod mpm_prefork

# Allow Apache to use Heroku-assigned port
RUN echo "Listen ${PORT}" >> /etc/apache2/ports.conf

EXPOSE 80

CMD ["apache2-foreground"]

