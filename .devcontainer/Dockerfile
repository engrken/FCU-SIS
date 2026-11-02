FROM php:8.2-cli-bookworm
RUN apt-get update \
    && apt-get install -y --no-install-recommends git ca-certificates \
    && docker-php-ext-install mysqli pdo_mysql \
    && rm -rf /var/lib/apt/lists/*
