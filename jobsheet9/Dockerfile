FROM php:8.3-cli

WORKDIR /app

RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo_pgsql

COPY . .

CMD ["sh", "-c", "php -S 0.0.0.0:${PORT:-8080} -t ."]