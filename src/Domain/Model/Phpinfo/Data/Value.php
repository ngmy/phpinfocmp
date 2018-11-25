<?php
declare(strict_types=1);

namespace Ngmy\PhpinfoComparator\Domain\Model\Phpinfo\Data;

use Ngmy\PhpinfoComparator\Domain\Model\AbstractValueObject;

class Value extends AbstractValueObject
{
    private $value;

    public static function createFromHtml(string $value): self
    {
        if ($value == 'no value') {
            return self::createEmpty();
        }
        return new self(html_entity_decode($value, ENT_QUOTES));
    }

    public static function createFromText(string $value): self
    {
        if ($value == 'no value') {
            return self::createEmpty();
        }
        return new self($value);
    }

    public static function createEmpty(): self
    {
        return new self('');
    }

    public function value(): string
    {
        return $this->value;
    }

    public function toHtml(string $label): string
    {
        return $label . ': ' . htmlentities($this->value, ENT_QUOTES) . '<br>';
    }

    public function equals($object): bool
    {
        return $object == $this;
    }

    private function __construct(string $value)
    {
        $this->value = $value;
    }
}
