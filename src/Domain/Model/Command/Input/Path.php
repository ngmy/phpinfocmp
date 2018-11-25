<?php
declare(strict_types=1);

namespace Ngmy\PhpinfoComparator\Domain\Model\Command\Input;

use Ngmy\PhpinfoComparator\Domain\Model\AbstractValueObject;
use InvalidArgumentException;

class Path extends AbstractValueObject
{
    private $value;

    public function __construct(string $value)
    {
        if (!file_exists($value)) {
            throw new InvalidArgumentException("The file does not exists (got \"$value\").");
        }
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
