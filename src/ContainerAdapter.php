<?php
declare(strict_types=1);

namespace Ngmy\PhpinfoComparator;

use Aura\Di\Container;
use Ngmy\PhpinfoComparator\ContainerFactory;

class ContainerAdapter
{
    public static function getContainer(): Container
    {
        return ContainerFactory::create();
    }
}
