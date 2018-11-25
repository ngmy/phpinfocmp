<?php
declare(strict_types=1);

namespace Ngmy\PhpinfoComparator\Domain\Model\Phpinfo\Data;

use Ngmy\PhpinfoComparator\Domain\Model\AbstractValueObject;

class Name extends AbstractValueObject
{
    private $value;

    public static function createFromHtml(string $value): self
    {
        return new self(html_entity_decode($value, ENT_QUOTES));
    }

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function toHtml(): string
    {
        return '<span style="font-weight:bold;">' . htmlentities($this->value, ENT_QUOTES) . '</span><br>';
    }

    public function equals($object): bool
    {
        return $object == $this;
    }
}
