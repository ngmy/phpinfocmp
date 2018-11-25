<?php
declare(strict_types=1);

namespace Ngmy\PhpinfoComparator\Domain\Model\Command;

use Ngmy\PhpinfoComparator\Domain\Model\Command\Command;
use Exception;

interface CommandReadWriterInterface
{
    public function read(): Command;

    public function displayError(Exception $exception): void;
}
