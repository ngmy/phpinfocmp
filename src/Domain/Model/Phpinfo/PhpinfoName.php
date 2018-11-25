<?php
declare(strict_types=1);

namespace Ngmy\PhpinfoComparator\Domain\Model\Phpinfo;

use Ngmy\PhpinfoComparator\Domain\Model\AbstractValueObject;

class PhpinfoName extends AbstractValueObject
{
    private $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals($object): bool
    {
        return $object == $this;
    }
}
