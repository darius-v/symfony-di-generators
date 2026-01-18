FROM php:8.5-cli

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    build-essential \
    libzip-dev \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Copy composer from official image
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

