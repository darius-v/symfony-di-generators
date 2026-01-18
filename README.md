# Setup 

`cd docker`

`docker build -t my-php-app .`

`docker compose up -d`

`docker compose exec php bash`

`composer install`

# Run application:
`php index.php`

# Quality checks

## All quality check

`./run_quality_check.sh`

## Separate checks

`vendor/bin/phpcs`

`vendor/bin/phpstan analyse src`

`vendor/bin/phpunit --colors tests`


## Code sniffer autofix
`vendor/bin/phpcbf`
