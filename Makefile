install-root-dependencies:
	composer update

install-coding-standard-dependencies:
	cd tools/php-cs-fixer && composer update --ignore-platform-req php

install-static-analysis-dependencies:
	cd tools/psalm && composer update

install-unit-tests-dependencies:
	cd tools/phpunit && composer update

coding-standard-fix:
	php tools/php-cs-fixer/vendor/bin/php-cs-fixer fix --config=tools/php-cs-fixer/.php_cs.dist.php

coding-standard-check:
	php tools/php-cs-fixer/vendor/bin/php-cs-fixer fix --config=tools/php-cs-fixer/.php_cs.dist.php --dry-run

static-analysis:
	php tools/psalm/vendor/bin/psalm -c tools/psalm/psalm.xml --show-info=true --no-cache

unit-tests:
	php tools/phpunit/vendor/bin/phpunit -c tools/phpunit/phpunit.xml.dist

check: coding-standard-check static-analysis unit-tests