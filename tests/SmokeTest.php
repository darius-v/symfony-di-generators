<?php

declare(strict_types=1);

namespace App\Tests;

use PHPUnit\Framework\TestCase;

class SmokeTest extends TestCase
{
    public function testScriptDoesNotCrash()
    {
        exec('php index.php', $output, $returnVar);

        $this->assertSame(0, $returnVar, 'index.php crashed');
    }
}
