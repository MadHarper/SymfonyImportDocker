FROM composer:1.6
FROM php:7.2-fpm-alpine3.7

ARG UID
ARG GUID
RUN echo http://dl-2.alpinelinux.org/alpine/edge/community/ >> /etc/apk/repositories
RUN apk --no-cache add shadow && usermod -u 1000 www-data
RUN apk --no-cache add shadow && groupmod -g 1000 www-data

RUN apk add --no-cache \
		git

ENV APCU_VERSION 5.1.11
ENV XDEBUG_VERSION 2.6.0

RUN set -xe \
	&& apk add --no-cache --virtual .build-deps \
		$PHPIZE_DEPS \
		icu-dev \
		postgresql-dev \
		zlib-dev \
	&& docker-php-ext-install \
		intl \
		pdo_pgsql \
		zip \
	&& pecl install \
		apcu-${APCU_VERSION} \
		xdebug-${XDEBUG_VERSION} \
		redis \
	&& docker-php-ext-enable --ini-name 20-apcu.ini apcu \
	&& docker-php-ext-enable --ini-name 05-opcache.ini opcache \
	&& docker-php-ext-enable --ini-name xdebug.ini xdebug \
	&& docker-php-ext-enable --ini-name redis.ini redis \
	&& runDeps="$( \
		scanelf --needed --nobanner --format '%n#p' --recursive /usr/local/lib/php/extensions \
			| tr ',' '\n' \
			| sort -u \
			| awk 'system("[ -e /usr/local/lib/" $1 " ]") == 0 { next } { print "so:" $1 }' \
	)" \
	&& apk add --no-cache --virtual .php-phpexts-rundeps $runDeps \
	&& apk del .build-deps \
    && { \
       echo "xdebug.remote_enable=On"; \
       echo "xdebug.remote_autostart=Off"; \
    }  >> /usr/local/etc/php/conf.d/xdebug.ini

#RUN pecl install -o -f redis \
#    &&  rm -rf /tmp/pear \
#    &&  docker-php-ext-enable redis

#RUN pecl install -o -f redis \
#    &&  rm -rf /tmp/pear \
#    &&  echo "extension=redis.so" > /usr/local/etc/php/conf.d/redis.ini

RUN curl -L https://github.com/FriendsOfPHP/PHP-CS-Fixer/releases/download/v2.11.1/php-cs-fixer.phar > /usr/local/bin/php-cs-fixer \
    && chmod +x /usr/local/bin/php-cs-fixer \
    && rm -rf /var/cache/apk/* /var/tmp/* /tmp/*

COPY --from=0 /usr/bin/composer /usr/bin/composer
COPY docker/php/php.ini /usr/local/etc/php/php.ini
COPY docker/php/docker-entrypoint.sh /usr/local/bin/docker-entrypoint
RUN chmod +x /usr/local/bin/docker-entrypoint


WORKDIR /app/symfony
ENTRYPOINT ["docker-entrypoint"]
CMD ["php-fpm"]

# https://getcomposer.org/doc/03-cli.md#composer-allow-superuser
ENV COMPOSER_ALLOW_SUPERUSER 1
RUN composer global require "hirak/prestissimo:^0.3" --prefer-dist --no-progress --no-suggest --classmap-authoritative

# Prevent the reinstallation of vendors at every changes in the source code
COPY composer.json ./
RUN composer install --prefer-dist --no-dev --no-autoloader --no-scripts --no-progress --no-suggest \
	&& composer clear-cache

COPY . ./

RUN mkdir -p var/cache var/logs var/sessions \
	&& composer dump-autoload --classmap-authoritative --no-dev \
	&& chown -R www-data var
