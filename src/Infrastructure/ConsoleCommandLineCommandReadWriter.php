<?php
declare(strict_types=1);

namespace Ngmy\PhpinfoComparator\Infrastructure;

use Ngmy\PhpinfoComparator\Domain\Model\Command\{
    Command,
    CommandReadWriterInterface
};
use Ngmy\PhpinfoComparator\Domain\Model\Command\Input\{
    AbstractInputFactory,
    InputPair
};
use Ngmy\PhpinfoComparator\Domain\Model\Command\Output\AbstractOutputFactory;
use Console_CommandLine;
use Exception;

class ConsoleCommandLineCommandReadWriter implements CommandReadWriterInterface
{
    private $parser;

    public function __construct(Console_CommandLine $parser)
    {
        $this->parser = $parser;
    }

    public function read(): Command
    {
        $result = $this->parser->parse();

        $inputFactory1 = AbstractInputFactory::createFactory(
            $result->args['phpinfo1'],
            [
                'fetch_mode'    => $result->options['fetch_mode1'],
                'fetch_options' => $result->options['fetch_options1'],
                'file_format'   => $result->options['file_format1'],
            ]
        );
        $inputFactory2 = AbstractInputFactory::createFactory(
            $result->args['phpinfo2'],
            [
                'fetch_mode'    => $result->options['fetch_mode2'],
                'fetch_options' => $result->options['fetch_options2'],
                'file_format'   => $result->options['file_format2'],
            ]
        );
        $input1 = $inputFactory1->createInput();
        $input2 = $inputFactory2->createInput();
        $inputPair = new InputPair($input1, $input2);

        $outputFactory = AbstractOutputFactory::createFactory('html');
        $output = $outputFactory->createOutput();

        return new Command($inputPair, $output);
    }

    public function displayError(Exception $exception): void
    {
        $this->parser->displayError($exception->getMessage(), false);
    }
}
