<?php

declare(strict_types=1);

namespace App\Converter;

class StringPositionConverter
{
    public function convert(string $input): string
    {
        $parts = [];

        foreach (str_split($input) as $char) {
            if (ctype_digit($char)) {
                $parts[] = $char;
            } elseif (ctype_alpha($char)) {
                $parts[] = ord(strtolower($char)) - 96;
            }
        }

        return implode('/', $parts);
    }
}
