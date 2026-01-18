<?php

declare(strict_types=1);

namespace App\Tests\Unit\Generator;

use App\Converter\ConverterInterface;
use App\Generator\OutputProcessor;
use App\Generator\Strategies\OutputStrategyInterface;
use App\Services\Printer;
use PHPUnit\Framework\TestCase;

class OutputProcessorTest extends TestCase
{
    public function testFirstStrategySupports(): void
    {
        $generatedValue = 'hello';
        $convertedValue = 'converted';

        $printer = $this->createStub(Printer::class);
        $converter = $this->createStub(ConverterInterface::class);
        $converter->method('convert')->with($generatedValue)->willReturn($convertedValue);

        $firstStrategy = $this->createMock(OutputStrategyInterface::class);
        $firstStrategy->method('supports')->with($generatedValue)->willReturn(true);
        $firstStrategy->expects($this->once())
            ->method('process')
            ->with($generatedValue, $converter, $printer);

        $secondStrategy = $this->createMock(OutputStrategyInterface::class);
        $secondStrategy->method('supports')->with($generatedValue)->willReturn(false);
        $secondStrategy->expects($this->never())->method('process');

        $processor = new OutputProcessor([$firstStrategy, $secondStrategy], $printer);
        $processor->process($generatedValue, $converter);
    }

    public function testSecondStrategySupports(): void
    {
        $generatedValue = 'hello';
        $convertedValue = 'converted';

        $printer = $this->createStub(Printer::class);
        $converter = $this->createStub(ConverterInterface::class);
        $converter->method('convert')->with($generatedValue)->willReturn($convertedValue);

        $firstStrategy = $this->createMock(OutputStrategyInterface::class);
        $firstStrategy->method('supports')->with($generatedValue)->willReturn(false);
        $firstStrategy->expects($this->never())->method('process');

        $secondStrategy = $this->createMock(OutputStrategyInterface::class);
        $secondStrategy->method('supports')->with($generatedValue)->willReturn(true);
        $secondStrategy->expects($this->once())
            ->method('process')
            ->with($generatedValue, $converter, $printer);

        $processor = new OutputProcessor([$firstStrategy, $secondStrategy], $printer);
        $processor->process($generatedValue, $converter);
    }
}
