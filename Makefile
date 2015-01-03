run:
	make composer
	make test
composer:
	composer install
test:
	php vendor/bin/phpunit tests --bootstrap ./vendor/autoload.php --colors 