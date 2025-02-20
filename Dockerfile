# Usar uma imagem oficial do PHP com extensões para Laravel
FROM php:8.2-fpm

# Definir o diretório de trabalho
WORKDIR /var/www/html

# Instalar dependências do sistema
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl \
    libonig-dev \
    libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql pdo_sqlite gd zip mbstring

# Instalar o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiar os arquivos do Laravel para o container
COPY . .

# Instalar dependências do Laravel
RUN composer install --no-dev --optimize-autoloader

# Ajustar permissões
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expor a porta padrão do Laravel
EXPOSE 8000

# Comando para rodar o servidor
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
