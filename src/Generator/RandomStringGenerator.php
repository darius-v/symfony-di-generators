<?php

declare(strict_types=1);

namespace App\Generator;

use Random\RandomException;

readonly class RandomStringGenerator implements GeneratorInterface
{
    public function __construct(
        private ?int $length = null
    ) {
    }

    /**
     * @throws RandomException
     */
    public function generate(?int $length = null): string
    {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'; // todo const
        $result = '';

        $length = $length ?? $this->length;

        for ($i = 0; $i < $length; $i++) {
            $result .= $chars[random_int(0, strlen($chars) - 1)];
        }

        return $result;
    }
}
