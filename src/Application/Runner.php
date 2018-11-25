<?php
declare(strict_types=1);

namespace Ngmy\PhpinfoComparator\Application;

use Ngmy\PhpinfoComparator\Domain\Model\Command\CommandReadWriterInterface;
use Exception;

class Runner
{
    private $commandReadWriter;

    public function __construct(CommandReadWriterInterface $commandReadWriter)
    {
        $this->commandReadWriter = $commandReadWriter;
    }

    public function runPhpinfocmp(): int
    {
        try {
            $command = $this->commandReadWriter->read();

            $phpinfoPair = $command->fetchInput();

            $command->generateOutput($phpinfoPair);

            return 0;
        } catch (Exception $exception) {
            $this->commandReadWriter->displayError($exception);

            return 1;
        }
    }
}
