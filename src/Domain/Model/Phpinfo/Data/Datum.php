<?php
declare(strict_types=1);

namespace Ngmy\PhpinfoComparator\Domain\Model\Phpinfo\Data;

use Ngmy\PhpinfoComparator\Domain\Model\AbstractValueObject;
use Ngmy\PhpinfoComparator\Domain\Model\Phpinfo\Data\{
    Name,
    Value
};

class Datum extends AbstractValueObject
{
    private $name;

    private $value;

    public function __construct(Name $name, Value $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    public function name(): Name
    {
        return $this->name;
    }

    public function value(): Value
    {
        return $this->value;
    }

    public function equals($object): bool
    {
        return $object == $this;
    }
}
