<?php
declare(strict_types=1);

namespace Ngmy\PhpinfoComparator\Domain\Model\Command\Input;

use Ngmy\PhpinfoComparator\Domain\Model\AbstractValueObject;
use InvalidArgumentException;

class Url extends AbstractValueObject
{
    private $value;

    public function __construct(string $value)
    {
        if (!preg_match('/^https?:\/\//i', $value)) {
            throw new InvalidArgumentException("The URL must be valid \"http\" or \"https\" (got \"$value\").");
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
