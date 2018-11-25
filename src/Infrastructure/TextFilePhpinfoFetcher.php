<?php
declare(strict_types=1);

namespace Ngmy\PhpinfoComparator\Infrastructure;

use Ngmy\PhpinfoComparator\Domain\Model\Command\Input\Path;
use Ngmy\PhpinfoComparator\Domain\Model\Phpinfo\{
    PhpinfoFactory,
    Phpinfo,
    TextPhpinfoParser,
    PhpinfoFetcherInterface
};

class TextFilePhpinfoFetcher implements PhpinfoFetcherInterface
{
    private $path;

    public function __construct(Path $path)
    {
        $this->path = $path;
    }

    public function fetch(): Phpinfo
    {
        $text = file_get_contents($this->path->value());

        return PhpinfoFactory::create(
            $this->path->value(),
            new TextPhpinfoParser($text)
        );
    }
}
