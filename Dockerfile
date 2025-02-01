# Escolher uma imagem base do PHP com o FPM
FROM php:8.2-fpm

# Instalar dependências do sistema
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libzip-dev \
    git \
    curl \
    zip \
    unzip \
    nodejs \
    npm \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip

# Instalar o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Definir o diretório de trabalho no container
WORKDIR /var/www

# Copiar o código do projeto para dentro do container
COPY . .

# Instalar as dependências do Composer e do Node.js
RUN composer install --no-autoloader --no-scripts
RUN npm install

# Gerar autoload do Composer
RUN composer dump-autoload --optimize

# Copiar o script de inicialização
COPY start.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh

# Expor a porta do PHP-FPM
EXPOSE 9000

# Definir o comando para rodar o script de inicialização
CMD ["/usr/local/bin/start.sh"]
