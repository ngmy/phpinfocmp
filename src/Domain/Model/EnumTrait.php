<?php
declare(strict_types=1);

namespace Ngmy\PhpinfoComparator\Domain\Model;

use BadMethodCallException;
use InvalidArgumentException;

trait EnumTrait
{
    private $scalar;

    final public function __construct($value)
    {
        if (!self::isValidValue($value)) {
            throw new InvalidArgumentException("Invalid enum value (value='{$value}')");
        }

        $this->scalar = $value;
    }

    final public static function isValidValue($value): bool
    {
        return in_array($value, self::ENUM, true);
    }

    final public static function isValidKey(string $key): bool
    {
        return array_key_exists($key, self::ENUM);
    }

    final public static function __callStatic(string $method, array $args)
    {
        if (!self::isValidKey($method)) {
            throw new BadMethodCallException("Undefined static method (method='{$method}')");
        }

        return new self(self::ENUM[$method]);
    }

    final public function __toString(): string
    {
        return (string) $this->scalar;
    }

    final public function value()
    {
        return $this->scalar;
    }

    final public function __set($key, $value): void
    {
        throw new BadMethodCallException('All setter is forbbiden');
    }
}
