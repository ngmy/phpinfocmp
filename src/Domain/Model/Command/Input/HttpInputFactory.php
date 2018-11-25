<?php
declare(strict_types=1);

namespace Ngmy\PhpinfoComparator\Domain\Model\Command\Input;

use Ngmy\PhpinfoComparator\ContainerAdapter;
use Ngmy\PhpinfoComparator\Domain\Model\Command\Input\{
    AbstractInputFactory,
    AbstractInput,
    HttpInput
};
use InvalidArgumentException;

class HttpInputFactory extends AbstractInputFactory
{
    public function createInput(): AbstractInput
    {
        $fetchOptions = [];
        if (!is_null($this->options['fetch_options'])) {
            if (!file_exists($this->options['fetch_options'])) {
                throw new InvalidArgumentException("The file does not exists (got \"{$this->options['fetch_options']}\").");
            }
            $fetchOptions = include $this->options['fetch_options'];
        }
        $container = ContainerAdapter::getContainer();
        $container->values['input_url'] = $this->phpinfo;
        $container->values['fetch_url'] = $this->phpinfo;
        $container->values['fetch_options'] = $fetchOptions;
        $input = $container->newInstance(HttpInput::class);
        return $input;
    }
}
