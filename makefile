dev:
	php -S localhost:8000 -t ./public;

migration-run:
	mysql -u root -p < migrations/0-init.sql;
	mysql -u root -p daimyocms < migrations/1-tables.sql;

migration-commit:
	mysqldump -u root -p -h 127.0.0.1 daimyocms > migrations/1-tables.sql;