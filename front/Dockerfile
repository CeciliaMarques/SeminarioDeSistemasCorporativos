FROM php:8.0-apache

# Instalar as extensões PHP necessárias para o CodeIgniter
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    libicu-dev \
    libcurl4-gnutls-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_mysql mysqli zip intl curl

# Copiar o código do CodeIgniter para o diretório de trabalho do Apache
COPY . /var/www/html/

RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer
RUN chmod +x /usr/local/bin/composer
RUN composer self-update

ADD conf/apache.conf /etc/apache2/sites-available/000-default.conf


RUN chmod -R 755 /var/www/html
RUN chown -R www-data:www-data /var/www/html

# Expor a porta 80 para o Apache
EXPOSE 80
 # Habilitar o módulo rewrite do Apache (necessário para o CodeIgniter)
RUN a2enmod rewrite 
RUN a2ensite  
RUN apt-get update && apt-get install -y curl git unzip 
RUN service apache2 restart
VOLUME /imagens/
WORKDIR /var/www/html

ENV API_URL=http://meusite.com.br/front/
# Expor a porta 80 para o Apache
EXPOSE 80

