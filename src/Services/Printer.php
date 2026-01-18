<?php

declare(strict_types=1);

namespace App\Services;

class Printer
{
    function print(string $original, string $converted): void
    {
        echo "Original: $original" . PHP_EOL;
        echo "Converted: $converted" . PHP_EOL;
        echo str_repeat('-', 20) . PHP_EOL;
    }
}
