# Use official PHP image with Apache
FROM php:8.2-apache

# Install required system packages
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev libzip-dev zip unzip git curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql gd zip

# Install MongoDB driver
RUN pecl install mongodb \
    && docker-php-ext-enable mongodb

# Enable Apache mod_rewrite (Laravel needs this for routes)
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy Laravel app into container
COPY . .

# Install Composer dependencies
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Expose port
EXPOSE 80

# Run Laravel with Apache
CMD ["apache2-foreground"]
