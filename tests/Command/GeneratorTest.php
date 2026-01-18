<?php

declare(strict_types=1);

namespace App\Tests\Command;

use App\Command\Generator;
use App\Converter\RandomConverterPicker;
use App\Converter\ConverterInterface;
use App\Collection\GeneratorCollection;
use App\Factory\GeneratorsCollectionFactory;
use App\Generator\GeneratorInterface;
use App\Generator\Strategies\OutputStrategyInterface;
use App\Services\Printer;
use PHPUnit\Framework\TestCase;

class GeneratorTest extends TestCase
{
    public function testItUsesSupportingStrategyToProcessValue(): void
    {
        $generatedRandomString = 'test';
        $convertedValue = 'converted';

        $converter = $this->converterStub($generatedRandomString, $convertedValue);

        $printer = $this->createStub(Printer::class);

        $strategy = $this->createMock(OutputStrategyInterface::class);
        $strategy->method('supports')->with($generatedRandomString)->willReturn(true);
        $strategy->expects($this->once())
            ->method('process')
            ->with($generatedRandomString, $converter, $printer);

        $generator = new Generator(
            $this->factoryStub($generatedRandomString),
            $printer,
            $this->converterPickerStub($converter),
            [$strategy]
        );

        $generator->generate();
    }

    private function factoryStub(string $generatedRandomString): GeneratorsCollectionFactory
    {
        $valueGenerator = $this->createStub(GeneratorInterface::class);
        $valueGenerator->method('generate')->willReturn($generatedRandomString);

        $collection = new GeneratorCollection();
        $collection->add($valueGenerator);

        $factory = $this->createStub(GeneratorsCollectionFactory::class);
        $factory->method('create')->willReturn($collection);

        return $factory;
    }

    private function converterStub(string $generatedRandomString, $convertedValue): ConverterInterface
    {
        $converter = $this->createStub(ConverterInterface::class);
        $converter->method('convert')->with($generatedRandomString)->willReturn($convertedValue);

        return $converter;
    }

    private function converterPickerStub(ConverterInterface $converter): RandomConverterPicker
    {
        $picker = $this->createStub(RandomConverterPicker::class);
        $picker->method('pick')->willReturn($converter);

        return $picker;
    }
}
