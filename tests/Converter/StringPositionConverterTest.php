<?php

declare(strict_types=1);

namespace App\Tests\Converter;

use App\Converter\StringPositionConverter;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class StringPositionConverterTest extends TestCase
{
    private StringPositionConverter $converter;

    protected function setUp(): void
    {
        $this->converter = new StringPositionConverter();
    }

    #[DataProvider('dataProvider')]
    public function testConvert(string $input, string $expected): void
    {
        $result = $this->converter->convert($input);
        $this->assertSame($expected, $result);
    }

    public static function dataProvider(): array
    {
        return [
            'letters only' => ['abc', '1/2/3'],
            'letters and uppercase' => ['aBc', '1/2/3'],
            'lowercase letters and digits' => ['a1b2', '1/1/2/2'],
            'digits only' => ['123', '123'],
            'mixed alphanumeric' => ['22aAcd', '22/1/1/3/4'],
            'empty string' => ['', ''],
        ];
    }
}
