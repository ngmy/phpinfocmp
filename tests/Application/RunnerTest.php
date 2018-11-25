<?php
declare(strict_types=1);

namespace Ngmy\PhpinfoComparator\Application;

use Ngmy\PhpinfoComparator\{
    ContainerAdapter,
    ContainerFactory,
    TestCase
};
use Ngmy\PhpinfoComparator\Application\Runner;
use Ngmy\PhpinfoComparator\Infrastructure\{
    ConsoleCommandLineCommandReadWriter,
    HttpPhpinfoFetcher
};
use Ngmy\PhpinfoComparator\Infrastructure\Library\Http\HttpRequestInterface;
use Console_CommandLine;
use Console_CommandLine_Result;
use Exception;
use Mockery;

class RunnerTest extends TestCase
{
    /**
     * @test
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function Should_NormalEnd_When_CompareTwoHtmlPhpinfoFilesOnTheRemoteServer()
    {
        $expectedResult = 0;
        $phpinfo1 = 'http://server1/phpinfo';
        $phpinfo2 = 'http://server2/phpinfo';

        $container1 = ContainerFactory::create();
        $container1->params[HttpPhpinfoFetcher::class]['request'] = $this->createHttpRequest([
            'request_url'   => $phpinfo1,
            'response_body' => file_get_contents($this->testDataDir . '/phpinfo1.html'),
        ]);
        $container2 = ContainerFactory::create();
        $container2->params[HttpPhpinfoFetcher::class]['request'] = $this->createHttpRequest([
            'request_url'   => $phpinfo2,
            'response_body' => file_get_contents($this->testDataDir . '/phpinfo2.html'),
        ]);
        $applicationManager = Mockery::mock('alias:' . ContainerAdapter::class);
        $applicationManager->shouldReceive('getContainer')->andReturn($container1, $container2);

        $consoleCommandLineResult = Mockery::mock(Console_CommandLine_Result::class);
        $consoleCommandLineResult->args['phpinfo1']          = $phpinfo1;
        $consoleCommandLineResult->options['fetch_mode1']    = 'http';
        $consoleCommandLineResult->options['fetch_options1'] = null;
        $consoleCommandLineResult->options['file_format1']   = 'html';
        $consoleCommandLineResult->args['phpinfo2']          = $phpinfo2;
        $consoleCommandLineResult->options['fetch_mode2']    = 'http';
        $consoleCommandLineResult->options['fetch_options2'] = null;
        $consoleCommandLineResult->options['file_format2']   = 'html';

        $runner = $this->createNormalEndRunner($consoleCommandLineResult);

        $actualResult = $runner->runPhpinfocmp();

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @test
     */
    public function Should_NormalEnd_When_CompareTwoHtmlPhpinfoFilesOnTheLocalMachine()
    {
        $expectedResult = 0;

        $consoleCommandLineResult = Mockery::mock(Console_CommandLine_Result::class);
        $consoleCommandLineResult->args['phpinfo1']          = $this->testDataDir . '/phpinfo1.html';
        $consoleCommandLineResult->options['fetch_mode1']    = 'file';
        $consoleCommandLineResult->options['fetch_options1'] = null;
        $consoleCommandLineResult->options['file_format1']   = 'html';
        $consoleCommandLineResult->args['phpinfo2']          = $this->testDataDir . '/phpinfo2.html';
        $consoleCommandLineResult->options['fetch_mode2']    = 'file';
        $consoleCommandLineResult->options['fetch_options2'] = null;
        $consoleCommandLineResult->options['file_format2']   = 'html';

        $runner = $this->createNormalEndRunner($consoleCommandLineResult);

        $actualResult = $runner->runPhpinfocmp();

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @test
     */
    public function Should_NormalEnd_When_CompareTwoTextPhpinfoFilesOnTheLocalMachine()
    {
        $expectedResult = 0;

        $consoleCommandLineResult = Mockery::mock(Console_CommandLine_Result::class);
        $consoleCommandLineResult->args['phpinfo1']          = $this->testDataDir . '/phpinfo1.txt';
        $consoleCommandLineResult->options['fetch_mode1']    = 'file';
        $consoleCommandLineResult->options['fetch_options1'] = null;
        $consoleCommandLineResult->options['file_format1']   = 'text';
        $consoleCommandLineResult->args['phpinfo2']          = $this->testDataDir . '/phpinfo2.txt';
        $consoleCommandLineResult->options['fetch_mode2']    = 'file';
        $consoleCommandLineResult->options['fetch_options2'] = null;
        $consoleCommandLineResult->options['file_format2']   = 'text';

        $runner = $this->createNormalEndRunner($consoleCommandLineResult);

        $actualResult = $runner->runPhpinfocmp();

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @test
     */
    public function Should_AbnormalEnd_When_AnExceptionIsThrown()
    {
        $expectedResult = 1;

        $consoleCommandLineResult = Mockery::mock(Console_CommandLine_Result::class);
        $consoleCommandLineResult->args['phpinfo1']          = 'https://127.0.0.1/phpinfo1';
        $consoleCommandLineResult->options['fetch_mode1']    = 'http';
        $consoleCommandLineResult->options['fetch_options1'] = null;
        $consoleCommandLineResult->options['file_format1']   = 'html';
        $consoleCommandLineResult->args['phpinfo2']          = 'https://127.0.0.1/phpinfo2';
        $consoleCommandLineResult->options['fetch_mode2']    = 'http';
        $consoleCommandLineResult->options['fetch_options2'] = null;
        $consoleCommandLineResult->options['file_format2']   = 'html';

        $runner = $this->createAbnormalEndRunner();

        $actualResult = $runner->runPhpinfocmp();

        $this->assertEquals($expectedResult, $actualResult);
    }

    private function createNormalEndRunner(Console_CommandLine_Result $consoleCommandLineResult): Runner
    {
        $consoleCommandLineParser = Mockery::mock(Console_CommandLine::class);
        $consoleCommandLineParser->shouldReceive('parse')->andReturn($consoleCommandLineResult);
        $commandReadWriter = new ConsoleCommandLineCommandReadWriter($consoleCommandLineParser);
        $runner = new Runner($commandReadWriter);
        return $runner;
    }

    private function createAbnormalEndRunner(): Runner
    {
        $exception = new Exception();
        $consoleCommandLineParser = Mockery::mock(Console_CommandLine::class);
        $consoleCommandLineParser->shouldReceive('parse')->andThrow($exception);
        $consoleCommandLineParser->shouldReceive('displayError')->with($exception->getMessage(), false);
        $commandReadWriter = new ConsoleCommandLineCommandReadWriter($consoleCommandLineParser);
        $runner = new Runner($commandReadWriter);
        return $runner;
    }

    private function createHttpRequest(array $params): HttpRequestInterface
    {
        return new class($params['request_url'], $params['response_body']) implements HttpRequestInterface {
            private $requestUrl;

            private $responseBody;

            public function __construct(string $requestUrl, string $responseBody)
            {
                $this->requestUrl = $requestUrl;
                $this->responseBody = $responseBody;
            }

            public function setOption($name, $value): void
            {
            }

            public function execute(): ?string
            {
                return $this->responseBody;
            }

            public function getInfo(): array
            {
                return ['url' => $this->requestUrl];
            }

            public function getError(): ?string
            {
                return null;
            }

            public function getErrorCode(): ?int
            {
                return null;
            }

            public function close(): void
            {
            }
        };
    }
}
