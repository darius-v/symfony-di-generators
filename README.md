Todo:
- integration test?
- retest readme

Done
- Why rot13 converter needed if php has this function?
- sniffer
- stan
- tests

To launch:

`cd docker`

Build:

`docker build -t my-php-app .`

Run
`docker compose up -d`

Bash:
`docker compose exec php bash`

Inside bash:

`composer install`

Run application:
`php index.php`

Sniffer

`vendor/bin/phpcs`

Autofix sniffer

`vendor/bin/phpcbf`

PHPStan

`vendor/bin/phpstan analyse src`

Tests

`vendor/bin/phpunit --colors tests`

All quality check:

`./run_quality_check.sh`
