<?php
declare(strict_types=1);

namespace Ngmy\PhpinfoComparator\Domain\Model\Command\Input;

use Ngmy\PhpinfoComparator\Domain\Model\{
    AbstractValueObject,
    EnumTrait
};

class Mode extends AbstractValueObject
{
    use EnumTrait;

    protected const ENUM = [
        'http' => 'http',
        'file' => 'file',
    ];

    public function equals($object): bool
    {
        return $object == $this;
    }
}
