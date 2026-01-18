#!/bin/sh

echo "Running PHP CodeSniffer..."
vendor/bin/phpcs
PHP_CODESNIFFER_EXIT_CODE=$?

echo ""
echo "Running PHPStan..."
vendor/bin/phpstan analyse src
PHPSTAN_EXIT_CODE=$?

echo ""
echo "Running PHPUnit tests..."
vendor/bin/phpunit --colors tests
PHPUNIT_EXIT_CODE=$?

# Exit with the first non-zero code (if any)
EXIT_CODE=0
if [ $PHP_CODESNIFFER_EXIT_CODE -ne 0 ]; then
    EXIT_CODE=$PHP_CODESNIFFER_EXIT_CODE
elif [ $PHPSTAN_EXIT_CODE -ne 0 ]; then
    EXIT_CODE=$PHPSTAN_EXIT_CODE
elif [ $PHPUNIT_EXIT_CODE -ne 0 ]; then
    EXIT_CODE=$PHPUNIT_EXIT_CODE
fi

exit $EXIT_CODE
