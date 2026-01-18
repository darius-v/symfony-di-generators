<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\ContainerBuilder;
use App\Command\Generator;
use App\Factory\GeneratorsCollectionFactory;
use App\Printer;

return static function (ContainerBuilder $container): void {
    $container->autowire(Printer::class)
        ->setPublic(true);

    $container->autowire(GeneratorsCollectionFactory::class)
        ->setPublic(true);

    $container->autowire(Generator::class)
        ->setPublic(true);
};
