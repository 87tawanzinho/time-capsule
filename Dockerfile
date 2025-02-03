# Use uma imagem oficial do PHP com Nginx
FROM php:8.2-fpm

# Instalar dependências necessárias
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copiar o código da aplicação
WORKDIR /var/www
COPY . .

# Definir permissões corretas para diretórios
RUN chown -R www-data:www-data /var/www

# Instalar dependências do Laravel
RUN composer install --no-dev --optimize-autoloader

# Expor a porta 9000
EXPOSE 9000

# Definir o entrypoint para o PHP-FPM
CMD ["php-fpm"]
