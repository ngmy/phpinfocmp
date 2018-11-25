<?php
declare(strict_types=1);

namespace Ngmy\PhpinfoComparator;

use PHPUnit\Framework\TestCase as PhpUnitTestCase;
use Mockery;

class TestCase extends PhpUnitTestCase
{
    protected $testDataDir = __DIR__ . '/data';

    protected function tearDown()
    {
        Mockery::close();
    }
}
