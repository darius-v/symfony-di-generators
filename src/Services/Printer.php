<?php

declare(strict_types=1);

namespace App\Services;

class Printer
{
    function print(string $original, array $convertedItems): void
    {
        foreach ($convertedItems as $convertedItem) {
            echo "Original: $original" . PHP_EOL;
            echo "Converted: $convertedItem" . PHP_EOL;
            echo str_repeat('-', 20) . PHP_EOL;
        }
    }
}
