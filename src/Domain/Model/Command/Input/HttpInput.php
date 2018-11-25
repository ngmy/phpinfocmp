<?php
declare(strict_types=1);

namespace Ngmy\PhpinfoComparator\Domain\Model\Command\Input;

use Ngmy\PhpinfoComparator\Domain\Model\Command\Input\{
    AbstractInput,
    Url,
    Format,
    Mode
};

class HttpInput extends AbstractInput
{
    protected $url;

    public function __construct(Url $url)
    {
        parent::__construct(Mode::http(), Format::html());

        $this->url = $url;
    }
}
