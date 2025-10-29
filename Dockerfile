FROM php:8.2-cli-alpine

# Extensoes necessarias (SQLite e mbstring) e utilitarios leves
RUN apk add --no-cache unzip sqlite-libs oniguruma-dev procps \
    && apk add --no-cache --virtual .build-deps sqlite-dev \
    && docker-php-ext-install pdo_sqlite mbstring \
    && apk del --no-network .build-deps

# Composer (PHAR)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Desabilita warnings do PHP em producao
RUN echo "error_reporting = E_ALL & ~E_WARNING & ~E_NOTICE & ~E_DEPRECATED" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "display_errors = Off" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "log_errors = On" >> /usr/local/etc/php/conf.d/custom.ini

WORKDIR /var/www/html

# Servidor embutido do PHP via Artisan (dev)
EXPOSE 8000

CMD ["sh", "-c", "mkdir -p bootstrap/cache database storage/logs storage/framework/cache storage/framework/sessions storage/framework/views && chmod -R 777 bootstrap/cache storage && composer install --no-scripts --no-interaction && php artisan key:generate --force && php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8000"]

