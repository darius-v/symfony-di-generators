<?php

declare(strict_types=1);

namespace App\Collection;

use App\Generator\GeneratorInterface;

class GeneratorCollection implements \IteratorAggregate
{
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
        return new \ArrayIterator($this->generators);
    }
}
