<?php

declare(strict_types=1);

namespace App\Command;

use App\Converter\RandomConverterPicker;
use App\Factory\GeneratorsCollectionFactory;
use App\Generator\GeneratorInterface;
use App\Generator\OutputProcessor;

readonly class Generator
{
    public function __construct(
        private GeneratorsCollectionFactory $factory,
        private RandomConverterPicker $converterPicker,
        private OutputProcessor $outputProcessor,
    ) {
    }

    public function generate(): void
    {
        $collection = $this->factory->create();

        /** @var GeneratorInterface $generator */
        foreach ($collection as $generator) {
            // random string or array of random strings
            $value = $generator->generate();

            $converter = $this->converterPicker->pick();

            $this->outputProcessor->process($value, $converter);
        }
    }
}
