# Dockerfile - PHP Application
FROM php:8.1-apache

# Instala extensão mysqli
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Copia a aplicação
COPY index.php /var/www/html/index.php

# Expõe porta 80
EXPOSE 80
