setup:
	composer install
	php artisan key:generate
	php artisan migrate
	npm install
	npm run build

lint:
	./vendor/bin/pint