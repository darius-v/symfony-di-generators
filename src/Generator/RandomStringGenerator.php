<?php

declare(strict_types=1);

namespace App\Generator;

use Random\RandomException;

readonly class RandomStringGenerator implements GeneratorInterface
{
    private int $defaultLength;

    public function __construct(
        int $defaultLength//todo rename
    ) {
        $this->defaultLength = $defaultLength;
    }

    /**
     * @throws RandomException
     */
    public function generate(?int $length = null): string
    {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $result = '';

        $length = $length ?? $this->defaultLength;

        for ($i = 0; $i < $length; $i++) {
            $result .= $chars[random_int(0, strlen($chars) - 1)];
        }

        return $result;
    }
}
