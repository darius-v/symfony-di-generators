<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use Symfony\Component\DependencyInjection\ContainerBuilder;
use App\Command\Generator;

$container = new ContainerBuilder();

// Load autowiring configuration
$services = require __DIR__ . '/src/Config/services.php';
$services($container);

// Mandatory for autowiring to work
$container->compile();

/** @var Generator $generator */
$generator = $container->get(Generator::class);
$generator->generate();
