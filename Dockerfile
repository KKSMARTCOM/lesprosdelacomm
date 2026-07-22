FROM php:8.2-fpm-alpine

# Installation des dépendances système et des extensions PHP (dont pdo_pgsql pour PostgreSQL)
RUN apk add --no-cache nginx wget libpng-dev libjpeg-turbo-dev freetype-dev zip libzip-dev unzip git openssl-dev openssh-client curl postgresql-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_pgsql gd zip bcmath

# Installation de Composer
RUN curl -sS https://getcomposer.org | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www

# Copie des fichiers du projet
COPY . .

# Installation des dépendances de production
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Configuration des permissions pour Laravel
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Copie de la configuration du serveur Web
COPY nginx.conf /etc/nginx/nginx.conf

EXPOSE 80

# Autorisation et lancement du script de démarrage
RUN chmod +x /var/www/deploy.sh
CMD ["/var/www/deploy.sh"]
