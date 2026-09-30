setup:
	composer install
	cp .env.example .env
	php artisan key:generate
	php artisan migrate
	pnpm install
	pnpm run build

lint:
	./vendor/bin/pint