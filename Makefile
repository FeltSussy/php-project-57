setup:
	composer install
	test -f .env || cp .env.example .env
	php artisan key:generate
	php artisan migrate
	npm install
	npm run build

lint:
	./vendor/bin/pint

coverage:
	XDEBUG_MODE=coverage composer exec --verbose phpunit tests -- --coverage-clover=storage/logs/clover.xml

phpstan:
	./vendor/bin/phpstan analyse --verbose