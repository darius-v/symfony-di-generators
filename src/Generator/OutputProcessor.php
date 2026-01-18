<?php

declare(strict_types=1);

namespace App\Generator;

use App\Converter\ConverterInterface;
use App\Services\Printer;

readonly class OutputProcessor
{
    public function __construct(private iterable $strategies, private Printer $printer)
    {
    }

    public function process(mixed $value, ConverterInterface $converter): void
    {
        foreach ($this->strategies as $strategy) {
            if ($strategy->supports($value)) {
                $strategy->process($value, $converter, $this->printer);
                return;
            }
        }

        throw new \LogicException('No output strategy supports given value');
    }
}
