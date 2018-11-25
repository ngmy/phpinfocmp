<?php
declare(strict_types=1);

namespace Ngmy\PhpinfoComparator\Domain\Model\Phpinfo;

use Ngmy\PhpinfoComparator\Domain\Model\Phpinfo\Data\Data;

interface PhpinfoParserInterface
{
    public function parse(): Data;
}
