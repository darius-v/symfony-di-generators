<?php

declare(strict_types=1);

namespace App\Factory;

use App\Collection\GeneratorCollection;
use App\Generator\RandomStringArrayGenerator;
use App\Generator\RandomStringGenerator;

class GeneratorsCollectionFactory
{
    public function create(): GeneratorCollection
    {
        $collection = new GeneratorCollection();

        $collection->add(new RandomStringGenerator(4));
        $collection->add(new RandomStringArrayGenerator(2, 20, new RandomStringGenerator(null)));

        return $collection;
    }
}
