<?php
declare(strict_types=1);

namespace Ngmy\PhpinfoComparator\Domain\Model\Command\Output;

use Ngmy\PhpinfoComparator\ContainerAdapter;
use Ngmy\PhpinfoComparator\Domain\Model\Command\Output\{
    AbstractOutputFactory,
    AbstractOutput,
    HtmlConsoleOutput
};

class HtmlConsoleOutputFactory extends AbstractOutputFactory
{
    public function createOutput(): AbstractOutput
    {
        $container = ContainerAdapter::getContainer();
        $output = $container->newInstance(HtmlConsoleOutput::class);
        return $output;
    }
}
