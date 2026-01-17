<?php

declare(strict_types=1);

namespace App\Generator;

use Random\RandomException;

readonly class RandomStringArrayGenerator implements GeneratorInterface
{
    private int $defaultLength;
    private RandomStringGenerator $generator;

    public function __construct(
        private int $arraySize,
        int $defaultLength,
        RandomStringGenerator $generator
    ) {
        $this->defaultLength = $defaultLength;
        $this->generator = $generator;
    }

    /**
     * @throws RandomException
     */
    public function generate(): array
    {
        return array_map(
            fn () => $this->generator->generate($this->defaultLength),
            range(1, $this->arraySize)
        );
    }
}
