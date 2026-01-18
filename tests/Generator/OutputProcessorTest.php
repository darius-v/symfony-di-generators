<?php

declare(strict_types=1);

namespace App\Tests\Generator;

use App\Converter\ConverterInterface;
use App\Generator\OutputProcessor;
use App\Generator\Strategies\OutputStrategyInterface;
use App\Services\Printer;
use PHPUnit\Framework\TestCase;

class OutputProcessorTest extends TestCase
{
    public function testItCallsSupportingStrategy(): void
    {
        $generatedValue = 'hello';
        $convertedValue = 'converted';

        $printer = $this->createStub(Printer::class);

        $converter = $this->createStub(ConverterInterface::class);
        $converter->method('convert')->with($generatedValue)->willReturn($convertedValue);

        $strategy = $this->createMock(OutputStrategyInterface::class);
        $strategy->method('supports')->with($generatedValue)->willReturn(true);
        $strategy->expects($this->once())
            ->method('process')
            ->with($generatedValue, $converter, $printer)
        ;

        $processor = new OutputProcessor([$strategy], $printer);

        $processor->process($generatedValue, $converter);
    }
}
