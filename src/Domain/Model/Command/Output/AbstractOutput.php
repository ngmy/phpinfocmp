<?php
declare(strict_types=1);

namespace Ngmy\PhpinfoComparator\Domain\Model\Command\Output;

use Ngmy\PhpinfoComparator\Domain\Model\AbstractValueObject;
use Ngmy\PhpinfoComparator\Domain\Model\Command\Output\OutputGeneratorInterface;
use Ngmy\PhpinfoComparator\Domain\Model\Phpinfo\PhpinfoPair;

abstract class AbstractOutput extends AbstractValueObject
{
    private $generator;

    public function setGenerator(OutputGeneratorInterface $generator): void
    {
        $this->generator = $generator;
    }

    public function generate(PhpinfoPair $phpinfoPair): void
    {
        $this->generator->generate($phpinfoPair);
    }

    public function equals($object): bool
    {
        return $object == $this;
    }
}
