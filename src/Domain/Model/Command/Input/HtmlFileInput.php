<?php
declare(strict_types=1);

namespace Ngmy\PhpinfoComparator\Domain\Model\Command\Input;

use Ngmy\PhpinfoComparator\Domain\Model\Command\Input\{
    AbstractFileInput,
    Path,
    Format
};

class HtmlFileInput extends AbstractFileInput
{
    public function __construct(Path $path)
    {
        parent::__construct($path, Format::html());
    }
}
