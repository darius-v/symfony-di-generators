<?php

declare(strict_types=1);

namespace App\Generator\Strategies;

use App\Converter\ConverterInterface;
use App\Services\Printer;

class ScalarOutputStrategy implements OutputStrategyInterface
{
    public function supports(mixed $value): bool
    {
        return !is_array($value);
    }

    public function process(
        mixed $value,
        ConverterInterface $converter,
        Printer $printer
    ): void {
        $converted = $converter->convert($value);
        $printer->print($value, $converted);
    }
}
