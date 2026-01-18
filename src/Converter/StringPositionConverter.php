<?php

declare(strict_types=1);

namespace App\Converter;

class StringPositionConverter implements ConverterInterface
{
    public function convert(string $input): string
    {
        $parts = [];

        // Match sequences of digits OR single letters
        preg_match_all('/\d+|[a-zA-Z]/', $input, $matches);

        foreach ($matches[0] as $match) {
            if (ctype_digit($match)) {
                // preserve full number
                $parts[] = $match;
            } elseif (ctype_alpha($match)) {
                // convert letter to position
                $parts[] = ord(strtolower($match)) - 96;
            }
        }

        return implode('/', $parts);
    }
}
