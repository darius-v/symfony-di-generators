<?php

declare(strict_types=1);

namespace App\Command;

use App\Converter\RandomConverterPicker;
use App\Factory\GeneratorsCollectionFactory;
use App\Generator\GeneratorInterface;
use App\Services\Printer;

readonly class Generator
{
    public function __construct(
        private GeneratorsCollectionFactory $factory,
        private Printer $printer,
        private RandomConverterPicker $randomConverterPicker,
    ) {
    }

    public function generate(): void
    {
        $collection = $this->factory->create();

        /** @var GeneratorInterface $generator */
        foreach ($collection as $generator) {
            $value = $generator->generate();
            $converter = $this->randomConverterPicker->pick();

            if (is_array($value)) {
                foreach ($value as $item) {
                    $converted = $converter->convert($item);
                    $this->printer->print($item, $converted);
                }
            } else {
                $converted = $converter->convert($value);
                $this->printer->print($value, $converted);
            }
        }
    }
}
