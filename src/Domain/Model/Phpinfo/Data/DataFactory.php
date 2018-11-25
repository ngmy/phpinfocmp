<?php
declare(strict_types=1);

namespace Ngmy\PhpinfoComparator\Domain\Model\Phpinfo\Data;

use Ngmy\PhpinfoComparator\Domain\Model\Phpinfo\PhpinfoParserInterface;

class DataFactory
{
    public static function create(PhpinfoParserInterface $parser): Data
    {
        return $parser->parse();
    }
}
