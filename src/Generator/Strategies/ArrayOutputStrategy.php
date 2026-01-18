<?php

declare(strict_types=1);

namespace App\Generator\Strategies;

use App\Converter\ConverterInterface;
use App\Services\Printer;

class ArrayOutputStrategy implements OutputStrategyInterface
{
    public function supports(mixed $value): bool
    {
        return is_array($value);
    }

    public function process(
        mixed $value,
        ConverterInterface $converter,
        Printer $printer
    ): void {
        foreach ($value as $item) {
            $converted = $converter->convert($item);
            $printer->print($item, $converted);
        }
    }
}
