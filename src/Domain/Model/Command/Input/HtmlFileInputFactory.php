<?php
declare(strict_types=1);

namespace Ngmy\PhpinfoComparator\Domain\Model\Command\Input;

use Ngmy\PhpinfoComparator\ContainerAdapter;
use Ngmy\PhpinfoComparator\Domain\Model\Command\Input\{
    AbstractInputFactory,
    AbstractInput,
    HtmlFileInput
};

class HtmlFileInputFactory extends AbstractInputFactory
{
    public function createInput(): AbstractInput
    {
        $container = ContainerAdapter::getContainer();
        $container->values['input_path'] = $this->phpinfo;
        $container->values['fetch_path'] = $this->phpinfo;
        $input = $container->newInstance(HtmlFileInput::class);
        return $input;
    }
}
