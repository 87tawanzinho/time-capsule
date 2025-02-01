# Use uma imagem PHP adequada para o Laravel
FROM php:8.2-fpm

# Instalar pacotes necessários (sem libpcntl-dev)
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip gd pdo pdo_mysql

# Instalar Composer (necessário para o Laravel)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Configurações do Laravel e do ambiente
WORKDIR /var/www

# Copiar o código do aplicativo Laravel
COPY . .

# Instalar dependências do Laravel (com o Composer)
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Expor a porta
EXPOSE 9000
CMD ["php-fpm"]
