<?php

declare(strict_types=1);

namespace App\Generator\Strategies;

use App\Converter\ConverterInterface;
use App\Services\Printer;

interface OutputStrategyInterface
{
    public function supports(mixed $value): bool;

    public function process(
        mixed $value,
        ConverterInterface $converter,
        Printer $printer
    ): void;
}
