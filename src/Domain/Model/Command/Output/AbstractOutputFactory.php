<?php
declare(strict_types=1);

namespace Ngmy\PhpinfoComparator\Domain\Model\Command\Output;

use Ngmy\PhpinfoComparator\Domain\Model\Command\Output\{
    AbstractOutput,
    HtmlConsoleOutputFactory
};

abstract class AbstractOutputFactory
{
    abstract public function createOutput(): AbstractOutput;

    public static function createFactory(string $outputFormat): self
    {
        $factory = new HtmlConsoleOutputFactory();
        return $factory;
    }

    private function __construct()
    {
    }
}
