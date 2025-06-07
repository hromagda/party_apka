# Použijeme oficiální PHP image s Apachem
FROM php:8.2-apache

# Instalace potřebných PHP rozšíření
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Instalace Composeru
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Nastavení pracovní složky
WORKDIR /var/www/html

# Zkopíruj Laravel soubory do kontejneru
COPY . /var/www/html


# Povolení .htaccess (kvůli mod_rewrite)
RUN a2enmod rewrite

# Nastavení oprávnění
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage

# Spuštění serveru
CMD ["apache2-foreground"]
