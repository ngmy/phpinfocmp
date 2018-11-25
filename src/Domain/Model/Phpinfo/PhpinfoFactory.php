<?php
declare(strict_types=1);

namespace Ngmy\PhpinfoComparator\Domain\Model\Phpinfo;

use Ngmy\PhpinfoComparator\Domain\Model\Phpinfo\{
    Phpinfo,
    PhpinfoName,
    Data\DataFactory
};

class PhpinfoFactory
{
    public static function create(string $phpinfoName, PhpinfoParserInterface $parser): Phpinfo
    {
        return new Phpinfo(
            new PhpinfoName($phpinfoName),
            DataFactory::create($parser)
        );
    }
}
