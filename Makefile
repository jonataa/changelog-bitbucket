run:
	make composer
	make test
	make doc	
composer:
	composer install
test:
	php vendor/bin/phpunit tests --bootstrap ./vendor/autoload.php --colors 
doc:
	php vendor/bin/phpdoc -d ./src -t ./doc
build:	
	php vendor/bin/box build