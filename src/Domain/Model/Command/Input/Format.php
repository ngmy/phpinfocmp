<?php
declare(strict_types=1);

namespace Ngmy\PhpinfoComparator\Domain\Model\Command\Input;

use Ngmy\PhpinfoComparator\Domain\Model\{
    AbstractValueObject,
    EnumTrait
};

class Format extends AbstractValueObject
{
    use EnumTrait;

    protected const ENUM = [
        'html' => 'http',
        'text' => 'text',
    ];

    public function equals($object): bool
    {
        return $object == $this;
    }
}
