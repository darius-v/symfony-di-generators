<?php

declare(strict_types=1);

namespace App\Factory;

use App\Collection\GeneratorCollection;
use App\Generator\RandomCharGenerator;
use App\Generator\RandomStringArrayGenerator;
use App\Generator\RandomStringGenerator;

readonly class GeneratorsCollectionFactory
{
    public function __construct(private RandomCharGenerator $randomCharGenerator)
    {
    }

    public function create(): GeneratorCollection
    {
        $collection = new GeneratorCollection();

        $collection->add(new RandomStringGenerator($this->randomCharGenerator, 4));
        $collection->add(new RandomStringArrayGenerator(2, 20, new RandomStringGenerator($this->randomCharGenerator)));

        return $collection;
    }
}
