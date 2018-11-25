<?php
declare(strict_types=1);

namespace Ngmy\PhpinfoComparator\Infrastructure;

use Console_CommandLine;

class ConsoleCommandLineParserFactory
{
    public static function create(): Console_CommandLine
    {
        $parser = new Console_CommandLine([
          'description' => 'phpinfo comparator',
          'version'     => '0.2.0',
        ]);

        $parser->addOption('fetch_mode1', [
            'long_name'   => '--fetch-mode1',
            'action'      => 'StoreString',
            'default'     => 'http',
            'choices'     => ['http', 'file'],
            'description' => 'Uses either the "http" or "file" fetcher for phpinfo1 (uses the "http" fetcher by default)',
        ]);
        $parser->addOption('fetch_mode2', [
            'long_name'   => '--fetch-mode2',
            'action'      => 'StoreString',
            'default'     => 'http',
            'choices'     => ['http', 'file'],
            'description' => 'Uses either the "http" or "file" fetcher for phpinfo2 (uses the "http" fetcher by default)',
        ]);

        $parser->addOption('file_format1', [
            'long_name'   => '--file-format1',
            'action'      => 'StoreString',
            'default'     => 'html',
            'choices'     => ['html', 'text'],
            'description' => 'Specify whether file format is the "html" or "text" for phpinfo1 (works only when using the "file" fetcher for phpinfo1, specify the "html" file format by default)',
        ]);
        $parser->addOption('file_format2', [
            'long_name'   => '--file-format2',
            'action'      => 'StoreString',
            'default'     => 'html',
            'choices'     => ['html', 'text'],
            'description' => 'Specify whether file format is the "html" or "text" for phpinfo2 (works only when using the "file" fetcher for phpinfo2, specify the "html" file format by default)',
        ]);

        $parser->addOption('fetch_options1', [
            'long_name'   => '--fetch-options1',
            'action'      => 'StoreString',
            'description' => 'Read fetch options from a specified PHP file for phpinfo1 (works only when using the "http" fetcher for phpinfo1)',
        ]);
        $parser->addOption('fetch_options2', [
            'long_name'   => '--fetch-options2',
            'action'      => 'StoreString',
            'description' => 'Read fetch options from a specified PHP file for phpinfo2 (works only when using the "http" fetcher for phpinfo2)',
        ]);

        $parser->addArgument('phpinfo1', [
            'description' => 'The URL or path of the phpinfo() file to compare',
        ]);
        $parser->addArgument('phpinfo2', [
            'description' => 'The URL or path of the phpinfo() file to compare',
        ]);

        return $parser;
    }
}
