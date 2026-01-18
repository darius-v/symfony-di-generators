<?php

declare(strict_types=1);

namespace App\Converter;

interface ConverterInterface
{
    public function convert(string $input): string;
}
