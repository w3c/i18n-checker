FROM php:8.3-apache

RUN set -eux; \
	apt-get -o Acquire::Retries=3 update; \
	DEBIAN_FRONTEND=noninteractive apt-get -o Acquire::Retries=3 install -y --no-install-recommends \
		curl \
		libicu-dev; \
	docker-php-ext-install -j"$(nproc)" intl; \
	rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

COPY . /var/www/html
COPY docker/apache/000-default.conf /etc/apache2/sites-available/000-default.conf

RUN set -eux; \
	cp conf/i18n.conf.dist conf/i18n.conf; \
	sed -i 's#^test_url=.*#test_url="http://localhost/tests/generate.php"#' conf/i18n.conf; \
	sed -i 's#^log4php.appender.A.File=.*#log4php.appender.A.File=/var/www/html/logs/i18n.log#' conf/log4php.properties; \
	touch logs/i18n.log; \
	chown -R www-data:www-data logs logs/i18n.log

EXPOSE 80

HEALTHCHECK --interval=30s --timeout=3s --start-period=5s --retries=3 \
	CMD curl -fsS http://localhost/www/index.php > /dev/null || exit 1
