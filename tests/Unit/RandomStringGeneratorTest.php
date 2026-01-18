<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use App\Generator\RandomCharGenerator;
use App\Generator\RandomStringGenerator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class RandomStringGeneratorTest extends TestCase
{
    #[DataProvider('lengthProvider')]
    public function testGenerate(
        ?int $constructorLength,
        ?int $generateLength,
        int $expectedLength
    ): void {
        $charGenerator = $this->createStub(RandomCharGenerator::class);
        $charGenerator
            ->method('generate')
            ->willReturn('a');

        $generator = new RandomStringGenerator(
            $charGenerator,
            $constructorLength
        );

        $result = $generator->generate($generateLength);

        self::assertSame(str_repeat('a', $expectedLength), $result);
    }

    public static function lengthProvider(): array
    {
        return [
            'uses constructor length when generate length is null' => [
                'constructorLength' => 5,
                'generateLength' => null,
                'expectedLength' => 5,
            ],
            'generate length used when constructor length is null' => [
                'constructorLength' => null,
                'generateLength' => 4,
                'expectedLength' => 4,
            ],
        ];
    }
}
