FROM php:8.3-fpm

# Установка системных зависимостей
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libzip-dev \
    libpq-dev \
    procps \
    supervisor \
    && docker-php-ext-install pdo pdo_pgsql pgsql zip

# Установка Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Копируем конфиги Supervisor
RUN mkdir -p /var/log/supervisor /etc/supervisor/conf.d
COPY ./supervisor/supervisord.conf /etc/supervisord.conf
COPY ./supervisor/*.conf /etc/supervisor/conf.d/

# Копируем php.ini
COPY ./php.ini /usr/local/etc/php/conf.d/custom.ini

# Очистка
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Рабочая директория
WORKDIR /app

# Установка прав доступа
RUN chown -R www-data:www-data /app

# Открываем порт
EXPOSE 9000

# Запуск Supervisor (он управляет и php-fpm, и очередью)
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]

