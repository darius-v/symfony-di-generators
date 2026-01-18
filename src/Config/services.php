<?php

declare(strict_types=1);

use App\Command\Generator;
use App\Converter\RandomConverterPicker;
use App\Converter\Rot13Converter;
use App\Converter\StringPositionConverter;
use App\Factory\GeneratorsCollectionFactory;
use App\Generator\OutputProcessor;
use App\Generator\Strategies\ArrayOutputStrategy;
use App\Generator\Strategies\ScalarOutputStrategy;
use App\Services\Printer;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Argument\TaggedIteratorArgument;

return static function (ContainerBuilder $container): void {
    $container->autowire(Printer::class)
        ->setPublic(true);

    $container->autowire(GeneratorsCollectionFactory::class)
        ->setPublic(true);

    $container->autowire(Generator::class)
        ->setPublic(true);

    $container->autowire(OutputProcessor::class)
        ->setPublic(true)
        ->setArguments([
            '$strategies' => new TaggedIteratorArgument('app.output_strategy'),
        ]);

    $container->autowire(StringPositionConverter::class)
        ->addTag('app.converter');

    $container->autowire(Rot13Converter::class)
        ->addTag('app.converter');

    $container->autowire(RandomConverterPicker::class)
        ->setPublic(true)
        ->setArguments([
            new TaggedIteratorArgument('app.converter')
        ]);

    $container->autowire(ArrayOutputStrategy::class)
        ->addTag('app.output_strategy');

    $container->autowire(ScalarOutputStrategy::class)
        ->addTag('app.output_strategy');

    $container->autowire(Generator::class)
        ->setPublic(true);

};
