FROM phpdockerio/php74-fpm:latest
WORKDIR "/application/app"

# Install selected extensions and other stuff
RUN apt-get update \
    && apt-get -y --no-install-recommends install php7.4-bcmath php7.4-amqp php7.4-bz2 php7.4-gd php7.4-intl wget \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

RUN alias composer='php composer.phar'