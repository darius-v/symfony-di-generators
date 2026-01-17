<?php

declare(strict_types=1);

namespace App\Collection;

use App\Generator\GeneratorInterface;
use stdClass;

class GeneratorCollection implements \IteratorAggregate {
    /**
     * @var GeneratorInterface[] 
     */
    private array $generators = [];

    public function add(GeneratorInterface $generator): void
    {
        $this->generators[] = $generator;
    }

    public function getIterator(): \Traversable
    {
        $a= new stdClass;

        return new \ArrayIterator($this->generators );
    }
}
