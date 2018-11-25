<?php
declare(strict_types=1);

namespace Ngmy\PhpinfoComparator\Domain\Model\Phpinfo\Data;

use Ngmy\PhpinfoComparator\Domain\Model\AbstractValueObject;
use Ngmy\PhpinfoComparator\Domain\Model\Phpinfo\Data\{
    Datum,
    Name
};

class Data extends AbstractValueObject
{
    private $data = [];

    public function __construct(array $data)
    {
        array_walk($data, [$this, 'addDatum']);
    }

    public function names(): array
    {
        return array_map(function (Datum $datum) {
            return $datum->name();
        }, $this->data);
    }

    public function get(Name $name): ?Datum
    {
        $data = array_filter($this->data, function (Datum $datum) use ($name) {
            return $datum->name()->equals($name);
        });
        return array_shift($data);
    }

    public function equals($object): bool
    {
        return $object == $this;
    }

    private function addDatum(Datum $datum): void
    {
        $this->data[] = $datum;
    }
}
