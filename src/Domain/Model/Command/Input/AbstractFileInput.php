<?php
declare(strict_types=1);

namespace Ngmy\PhpinfoComparator\Domain\Model\Command\Input;

use Ngmy\PhpinfoComparator\Domain\Model\Command\Input\{
    AbstractInput,
    Path,
    Format,
    Mode
};

abstract class AbstractFileInput extends AbstractInput
{
    protected $path;

    public function __construct(Path $path, Format $format)
    {
        parent::__construct(Mode::file(), $format);

        $this->path = $path;
    }
}
