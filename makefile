dev:
	php -S localhost:8000 -t ./public;

migration-run:
	mysql -u root -p < references/0-init.sql;
	mysql -u root -p daimyocms < references/1-tables.sql;

migration-commit:
	mysqldump -u root -p -h 127.0.0.1 daimyocms > references/1-tables.sql;