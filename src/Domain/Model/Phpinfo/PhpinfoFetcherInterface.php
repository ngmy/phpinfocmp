<?php
declare(strict_types=1);

namespace Ngmy\PhpinfoComparator\Domain\Model\Phpinfo;

use Ngmy\PhpinfoComparator\Domain\Model\Phpinfo\Phpinfo;

interface PhpinfoFetcherInterface
{
    public function fetch(): Phpinfo;
}
