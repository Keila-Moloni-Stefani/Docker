# Dockerfile - PHP Application
FROM php:8.1-apache

# Instala extensão mysqli
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Copia a aplicação
COPY index.php /var/www/html/index.php

# Expõe porta 80
EXPOSE 80

# Dockerfile.nginx - Load Balancer
FROM nginx:latest

# Remove config padrão e copia essa
RUN rm /etc/nginx/conf.d/default.conf
COPY nginx.conf /etc/nginx/nginx.conf

EXPOSE 4500
