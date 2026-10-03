setup:
	composer install
	test -f .env || cp .env.example .env
	php artisan key:generate
	php artisan migrate --seed
	npm install
	npm run build

start-app:
	php artisan serve

test:
	php artisan test

lint:
	./vendor/bin/pint

coverage:
	XDEBUG_MODE=coverage composer exec --verbose phpunit tests -- --coverage-clover=storage/logs/clover.xml

coverage-show:
	XDEBUG_MODE=coverage composer exec --verbose phpunit -- --coverage-text

phpstan:
	./vendor/bin/phpstan analyse --verbose
