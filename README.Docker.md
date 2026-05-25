# Docker Development

This setup runs the checker with Apache and PHP in a container. It creates the
runtime `conf/i18n.conf` inside the image, so a local config copy is not needed.

## Start

```sh
docker compose up --build
```

Open:

```text
http://localhost:8000/
```

The container redirects `/` to `/www/index.php`.

To use another host port:

```sh
I18N_CHECKER_PORT=8080 docker compose up --build
```

## Regression Tests

Open:

```text
http://localhost:8000/www/test.php
```

The Docker image sets `test_url` to `http://localhost/tests/generate.php` so the
container can fetch generated fixtures from its own Apache server.

## Notes

The image enables the PHP `intl` extension used by language display; the base PHP image provides the `curl` and `mbstring` extensions used by the checker.
