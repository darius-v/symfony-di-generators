<?php

declare(strict_types=1);

namespace App\Converter;

readonly class RandomConverterPicker
{
    public function __construct(public iterable $converters)
    {
    }

    public function pick(): ConverterInterface
    {
        $convertersArray = iterator_to_array($this->converters);
        return $convertersArray[array_rand($convertersArray)];
    }
}
