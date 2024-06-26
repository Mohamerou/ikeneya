FROM richarvey/nginx-php-fpm:latest

# Install system dependencies
RUN apk add --no-cache \
    autoconf \
    build-base \
    openssl-dev \
    linux-headers \
    && rm -rf /var/cache/apk/*

# Install gRPC extension
RUN pecl install grpc-1.42.0 \
    && docker-php-ext-enable grpc

# Copy application code
COPY . .

# Set environment variables
ENV SKIP_COMPOSER 1
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

# Laravel config
ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr

# Create a non-root user for Composer (optional)
# USER composer

CMD ["/start.sh"]
