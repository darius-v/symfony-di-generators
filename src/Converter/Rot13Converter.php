<?php

declare(strict_types=1);

namespace App\Converter;

class Rot13Converter
{
    public function convert(string $input): string
    {
        return str_rot13($input);
    }
}
