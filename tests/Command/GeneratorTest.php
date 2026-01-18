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
use App\Services\Printer;
use App\Generator\Strategies\OutputStrategyInterface;
use PHPUnit\Framework\TestCase;

class GeneratorTest extends TestCase
{
    public function testItUsesOutputProcessor(): void
    {
        $generatedValue = 'test';
        $convertedValue = 'converted';

        $valueGenerator = $this->createStub(GeneratorInterface::class);
        $valueGenerator->method('generate')->willReturn($generatedValue);

        $collection = new GeneratorCollection();
        $collection->add($valueGenerator);

        $factory = $this->createStub(GeneratorsCollectionFactory::class);
        $factory->method('create')->willReturn($collection);

        $converter = $this->createStub(ConverterInterface::class);
        $converter->method('convert')->with($generatedValue)->willReturn($convertedValue);

        $picker = $this->createStub(RandomConverterPicker::class);
        $picker->method('pick')->willReturn($converter);

        $printer = $this->createStub(Printer::class);

        $strategy = $this->createMock(OutputStrategyInterface::class);
        $strategy->method('supports')->with($generatedValue)->willReturn(true);
        $strategy->expects($this->once())
            ->method('process')
            ->with($generatedValue, $converter, $printer);

        $processor = new OutputProcessor([$strategy], $printer);

        $generator = new Generator($factory, $picker, $processor);

        $generator->generate();
    }
}
