install:
	composer install;
	npm install;

start:
	bin/console server:start;

stop:
	app/bin/console server:stop;

build:
	./node_modules/.bin/encore dev

watch:
	./node_modules/.bin/encore dev --watch

build-prod:
	./node_modules/.bin/encore production