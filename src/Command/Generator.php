<?php

declare(strict_types=1);

namespace App\Command;

use App\Converter\RandomConverterPicker;
use App\Factory\GeneratorsCollectionFactory;
use App\Generator\GeneratorInterface;
use App\Generator\Strategies\OutputStrategyInterface;
use App\Services\Printer;

readonly class Generator
{
    public function __construct(
        private GeneratorsCollectionFactory $factory,
        private Printer $printer,
        private RandomConverterPicker $randomConverterPicker,
        private iterable $outputStrategies,
    ) {
    }

    public function generate(): void
    {
        $collection = $this->factory->create();

        /** @var GeneratorInterface $generator */
        foreach ($collection as $generator) {
            $value = $generator->generate();
            $converter = $this->randomConverterPicker->pick();

            $this->processValue($value, $converter);
        }
    }

    private function processValue(mixed $value, $converter): void
    {
        /** @var OutputStrategyInterface $strategy */
        foreach ($this->outputStrategies as $strategy) {
            if ($strategy->supports($value)) {
                $strategy->process($value, $converter, $this->printer);
                return;
            }
        }

        throw new \LogicException('No output strategy supports given value');
    }
}
