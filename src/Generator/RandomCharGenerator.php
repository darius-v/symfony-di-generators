<?php

declare(strict_types=1);

namespace App\Generator;

class RandomCharGenerator
{
    private const string CHARS = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

    public function generate(): string
    {
        return self::CHARS[random_int(0, strlen(self::CHARS) - 1)];
    }
}
