FROM alinmigea/php:v1

USER root

RUN apk add --update --no-cache \
        libxml2 \
    && apk add --no-cache --virtual build-deps \
        $PHPIZE_DEPS \
        libxml2-dev \
    && apk del --purge build-deps \
    && rm -rf /var/cache/apk/* \
    && rm -rf /tmp/*

WORKDIR /var/www/emag-hero

COPY . .

RUN chown -R root:root vendor/bin/*

USER www-data


