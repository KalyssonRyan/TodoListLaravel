# Usar a imagem oficial do Laravel Sail baseada no PHP 8.4
FROM laravelsail/php82-composer AS base

# Definir diretório de trabalho
WORKDIR /var/www/html

# Copiar os arquivos do Laravel para dentro do container
COPY . .

# Instalar dependências do Laravel
RUN composer install --no-dev --optimize-autoloader

# Criar diretório de cache do framework
RUN mkdir -p bootstrap/cache && chmod -R 777 bootstrap/cache

# Criar banco SQLite no diretório /tmp/
RUN touch /tmp/database.sqlite

# Expor a porta padrão do Laravel
EXPOSE 8000

# Comando para rodar o servidor Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=${PORT:-8000}"]
CMD ["sh", "-c", "echo '🚀 Laravel está rodando em http://0.0.0.0:${PORT:-8000}' && php artisan serve --host=0.0.0.0 --port=${PORT:-8000}"]

