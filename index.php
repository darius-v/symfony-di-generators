<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use App\Factory\GeneratorsCollectionFactory;

$generator = new \App\Command\Generator(new GeneratorsCollectionFactory());

$generator->generate();
