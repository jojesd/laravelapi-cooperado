# Use a imagem oficial do PHP para Laravel
FROM php:8.0-fpm

# Instale dependências do sistema e extensões do PHP necessárias para o Laravel
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Instale o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Configure o diretório de trabalho como o diretório do aplicativo Laravel
WORKDIR /var/www/html

# Copie os arquivos do aplicativo Laravel para o contêiner
COPY . .
# Instale as dependências do Composer
RUN COMPOSER_ALLOW_SUPERUSER=1 composer install

# Expose port 9000 to communicate with PHP-FPM
EXPOSE 9000

# Install nginx
RUN apt-get install -y nginx

# Remove default nginx configs
RUN rm /etc/nginx/sites-enabled/default

# Copy custom nginx config
COPY laravel-nginx.conf /etc/nginx/sites-available/laravel

# Enable laravel site
RUN ln -s /etc/nginx/sites-available/laravel /etc/nginx/sites-enabled/

# Start nginx and PHP-FPM
CMD service nginx start && php-fpm

# Execute o servidor Laravel quando o contêiner for iniciado
CMD php artisan serve --host=0.0.0.0 --port=8000
