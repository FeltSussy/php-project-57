setup:
	composer install
	cp .env.example .env
	php artisan key:generate
	php artisan migrate
	pnpm install

build:
	pnpm run build

lint:
	./vendor/bin/pint