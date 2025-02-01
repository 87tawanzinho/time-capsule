# Use a imagem oficial do PHP com FPM (FastCGI Process Manager)
FROM php:8.2-fpm

# Instalar dependências do sistema
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    git \
    nginx \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install pdo pdo_mysql

# Instalar dependências do Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Definir o diretório de trabalho
WORKDIR /var/www/html

# Copiar o código fonte da aplicação para o container
COPY . .

# Rodar o Composer para instalar as dependências do Laravel
RUN composer install

# Copiar o arquivo de configuração do Nginx para o container
COPY ./nginx/default.conf /etc/nginx/conf.d/default.conf

# Expor a porta 80, para que o Nginx possa servir a aplicação
EXPOSE 80

# Iniciar o Nginx e PHP-FPM quando o container for iniciado
CMD php-fpm & nginx -g 'daemon off;'
