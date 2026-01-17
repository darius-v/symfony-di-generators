<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use App\Generator\GeneratorInterface;
use App\Generator\RandomStringGenerator;
use App\Generator\RandomStringArrayGenerator;
use App\Converter\StringPositionConverter;
use App\Converter\Rot13Converter;
use App\Collection\GeneratorCollection;

$collection = new GeneratorCollection();

$collection->add(new RandomStringGenerator(4));
$collection->add(new RandomStringArrayGenerator(2, 3, new RandomStringGenerator(2)));

$converters = [
    new StringPositionConverter(),
    new Rot13Converter(),
];

/** @var GeneratorInterface $generator */
foreach ($collection as $generator) {
    $value = $generator->generate();
    $converter = $converters[array_rand($converters)]; // pick a random converter

    if (is_array($value)) {
        foreach ($value as $item) {
            $converted = $converter->convert($item);
            showOutput($item, $converted);
        }
    } else {
        $converted = $converter->convert($value);
        showOutput($value, $converted);
    }
}

function showOutput(string $original, string $converted): void
{
    echo "Original: $original" . PHP_EOL;
    echo "Converted: $converted" . PHP_EOL;
    echo str_repeat('-', 20) . PHP_EOL;
}
