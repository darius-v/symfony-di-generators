<?php

declare(strict_types=1);

namespace App\Generator;

readonly class RandomStringGenerator implements GeneratorInterface
{
    public function __construct(
        private RandomCharGenerator $randomCharGenerator,
        private ?int $length = null
    ) {
    }

    public function generate(?int $length = null): string
    {
        $result = '';

        $length = $length ?? $this->length;

        for ($i = 0; $i < $length; $i++) {
            $result .= $this->randomCharGenerator->generate();
        }

        return $result;
    }
}
