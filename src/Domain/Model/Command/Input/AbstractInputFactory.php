<?php
declare(strict_types=1);

namespace Ngmy\PhpinfoComparator\Domain\Model\Command\Input;

use Ngmy\PhpinfoComparator\Domain\Model\Command\Input\{
    AbstractInput,
    HttpInputFactory,
    HtmlFileInputFactory,
    TextFileInputFactory
};
use InvalidArgumentException;

abstract class AbstractInputFactory
{
    protected $phpinfo;

    protected $options;

    abstract public function createInput(): AbstractInput;

    public static function createFactory(string $phpinfo, array $options): self
    {
        if ($options['fetch_mode'] == 'http') {
            $factory = new HttpInputFactory($phpinfo, $options);
        } elseif ($options['file_format'] == 'html') {
            $factory = new HtmlFileInputFactory($phpinfo, $options);
        } else {
            $factory = new TextFileInputFactory($phpinfo, $options);
        }
        return $factory;
    }

    private function __construct(string $phpinfo, array $options)
    {
        $this->phpinfo = $phpinfo;
        $this->options = $options;
    }
}
