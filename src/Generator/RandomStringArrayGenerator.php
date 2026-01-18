<?php

declare(strict_types=1);

namespace App\Generator;

use Random\RandomException;

readonly class RandomStringArrayGenerator implements GeneratorInterface
{
    private RandomStringGenerator $generator;

    public function __construct(
        private int $arraySize,
        private int $lengthOfGeneratedStrings,
        RandomStringGenerator $generator
    ) {
        $this->generator = $generator;
    }

    /**
     * @throws RandomException
     */
    public function generate(): array
    {
        return array_map(
            fn () => $this->generator->generate($this->lengthOfGeneratedStrings),
            range(1, $this->arraySize)
        );
    }
}
