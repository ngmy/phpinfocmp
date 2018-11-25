<?php
declare(strict_types=1);

namespace Ngmy\PhpinfoComparator\Domain\Model\Command\Output;

use Ngmy\PhpinfoComparator\Domain\Model\Phpinfo\PhpinfoPair;

interface OutputGeneratorInterface
{
    public function generate(PhpinfoPair $phpinfoPair): void;
}
