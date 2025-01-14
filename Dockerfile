# Use PHP 8.2 with Apache as the base image
FROM php:8.2-apache

# Install SQLite3 development libraries and other necessary tools
RUN apt-get update && apt-get install -y \
    sqlite3 \
    libsqlite3-dev \
    && docker-php-ext-install pdo pdo_sqlite

# Enable mod_rewrite for Apache
RUN a2enmod rewrite

# Copy the custom Apache configuration file
COPY docker/apache.conf /etc/apache2/sites-available/000-default.conf

# Set the working directory inside the container
WORKDIR /var/www/html

# Copy the Laravel project into the container
COPY . /var/www/html

# Install Composer (dependency manager for PHP)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Laravel dependencies
RUN composer install

# Expose port 80 for Apache
EXPOSE 80
