<?php
declare(strict_types=1);

namespace Ngmy\PhpinfoComparator\Domain\Model\Phpinfo;

use Ngmy\PhpinfoComparator\Domain\Model\AbstractEntity;
use Ngmy\PhpinfoComparator\Domain\Model\Phpinfo\{
    PhpinfoName,
    Data\Data
};

class Phpinfo extends AbstractEntity
{
    private $name;

    private $data;

    public function __construct(PhpinfoName $name, Data $data)
    {
        $this->name = $name;
        $this->data = $data;
    }

    public function name(): PhpinfoName
    {
        return $this->name;
    }

    public function data(): Data
    {
        return $this->data;
    }

    public function equals($object): bool
    {
        $equalObjects = false;

        if (!is_null($object) && $object instanceof self) {
            $equalObjects = $this->name()->equals($object->name());
        }

        return $equalObjects;
    }
}
