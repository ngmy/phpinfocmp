<?php
declare(strict_types=1);

namespace Ngmy\PhpinfoComparator\Domain\Model\Command;

use Ngmy\PhpinfoComparator\Domain\Model\Command\Input\InputPair;
use Ngmy\PhpinfoComparator\Domain\Model\Command\Output\AbstractOutput;
use Ngmy\PhpinfoComparator\Domain\Model\Phpinfo\PhpinfoPair;

class Command
{
    private $inputPair;

    private $output;

    public function __construct(InputPair $inputPair, AbstractOutput $output)
    {
        $this->inputPair = $inputPair;
        $this->output = $output;
    }

    public function fetchInput(): PhpinfoPair
    {
        return $this->inputPair->fetch();
    }

    public function generateOutput(PhpinfoPair $phpinfoPair): void
    {
        $this->output->generate($phpinfoPair);
    }
}
