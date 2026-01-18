<?php

declare(strict_types=1);

namespace App\Command;

use App\Converter\Rot13Converter;
use App\Converter\StringPositionConverter;
use App\Factory\GeneratorsCollectionFactory;
use App\Generator\GeneratorInterface;
use App\Printer;

readonly class Generator
{
    public function __construct(private GeneratorsCollectionFactory $factory, private Printer $printer)
    {
    }

    public function generate(): void
    {
        $collection = $this->factory->create();

        $converters = [
            new StringPositionConverter(),
            new Rot13Converter(),
        ];

        /** @var GeneratorInterface $generator */
        foreach ($collection as $generator) {
            $value = $generator->generate();
            $converter = $converters[array_rand($converters)]; // pick a random converter

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
