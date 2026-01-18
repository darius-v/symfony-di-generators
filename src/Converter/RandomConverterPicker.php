<?php

declare(strict_types=1);

namespace App\Converter;

class RandomConverterPicker
{
    public function pick(): StringPositionConverter|Rot13Converter
    {
        $converters = [
            new StringPositionConverter(),
            new Rot13Converter(),
        ];

        return $converters[array_rand($converters)]; // pick a random converter
    }
}
