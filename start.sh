#!/bin/bash

# Rodar o Composer (instalar dependências)
composer install

# Rodar o npm (instalar dependências do Node.js)
npm install

# Rodar o npm run dev (compilar os assets do frontend)
npm run dev

# Rodar o composer run dev (se houver algum script dev no composer.json)
composer run dev

# Rodar o PHP-FPM para que o container continue rodando
php-fpm
