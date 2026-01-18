#!/bin/sh

echo "Running PHP CodeSniffer..."
vendor/bin/phpcs
if [ $? -ne 0 ]; then
    echo "❌ PHP CodeSniffer failed!"
    exit 1
fi

echo ""
echo "Running PHPStan..."
vendor/bin/phpstan analyse src
if [ $? -ne 0 ]; then
    echo "❌ PHPStan failed!"
    exit 1
fi

echo ""
echo "Running PHPUnit tests..."
vendor/bin/phpunit --colors tests
if [ $? -ne 0 ]; then
    echo "❌ PHPUnit tests failed!"
    exit 1
fi

echo ""
echo "✅ All checks passed!"
exit 0
