<?php

declare(strict_types=1);

namespace App\Tests\Command;

use App\Command\Generator;
use App\Converter\RandomConverterPicker;
use App\Converter\ConverterInterface;
use App\Collection\GeneratorCollection;
use App\Factory\GeneratorsCollectionFactory;
use App\Generator\GeneratorInterface;
use App\Generator\OutputProcessor;
use PHPUnit\Framework\TestCase;

class GeneratorTest extends TestCase
{
    public function testItDelegatesToOutputProcessor(): void
    {
        $generatedValue = 'test';
        $converter = $this->createStub(ConverterInterface::class);

        $valueGenerator = $this->createStub(GeneratorInterface::class);
        $valueGenerator->method('generate')->willReturn($generatedValue);

        $collection = new GeneratorCollection();
        $collection->add($valueGenerator);

        $factory = $this->createStub(GeneratorsCollectionFactory::class);
        $factory->method('create')->willReturn($collection);

        $picker = $this->createStub(RandomConverterPicker::class);
        $picker->method('pick')->willReturn($converter);

        $processor = $this->getMockBuilder(OutputProcessor::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['process'])
            ->getMock();
        $processor->expects($this->once())
            ->method('process')
            ->with($generatedValue, $converter);

        $generator = new Generator($factory, $picker, $processor);

        $generator->generate();
    }
}
