<?php
declare(strict_types=1);

namespace Ngmy\PhpinfoComparator\Domain\Model\Command\Input;

use Ngmy\PhpinfoComparator\Domain\Model\AbstractValueObject;
use Ngmy\PhpinfoComparator\Domain\Model\Command\Input\{
    Format,
    Mode
};
use Ngmy\PhpinfoComparator\Domain\Model\Phpinfo\PhpinfoFetcherInterface;

abstract class AbstractInput extends AbstractValueObject
{
    protected $mode;

    protected $format;

    protected $fetcher;

    public function __construct(Mode $mode, Format $format)
    {
        $this->mode = $mode;
        $this->format = $format;
    }

    public function setFetcher(PhpinfoFetcherInterface $fetcher): void
    {
        $this->fetcher = $fetcher;
    }

    public function fetcher(): PhpinfoFetcherInterface
    {
        return $this->fetcher;
    }

    public function equals($object): bool
    {
        return $object == $this;
    }
}
