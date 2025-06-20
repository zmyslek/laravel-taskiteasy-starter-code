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


# Stage 1: PHP-FPM base
FROM php:8.2-fpm AS php-base

# Install PHP extensions
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev libpng-dev libonig-dev libxml2-dev zip \
    && docker-php-ext-install pdo pdo_mysql zip mbstring exif pcntl

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working dir
WORKDIR /var/www/html

# Copy Laravel app
COPY . .

# Install PHP dependencies
RUN composer install --optimize-autoloader --no-dev

# Set permissions
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Stage 2: Final container with PHP + Nginx
FROM nginx:alpine

# Copy Laravel app and nginx config
COPY --from=php-base /var/www/html /var/www/html
COPY ./docker/nginx/default.conf /etc/nginx/conf.d/default.conf
COPY ./docker/nginx.conf /etc/nginx/nginx.conf

# Copy php-fpm socket service if you're running them together in same container
RUN apk add --no-cache php8 php8-fpm php8-mysqli php8-pdo php8-pdo_mysql

# Set working directory
WORKDIR /var/www/html

# Start services
CMD ["sh", "-c", "php-fpm8 && nginx -g 'daemon off;'"]
