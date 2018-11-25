<?php
declare(strict_types=1);

namespace Ngmy\PhpinfoComparator;

use Aura\Di\{
    Container,
    ContainerBuilder
};
use Ngmy\PhpinfoComparator\Application\Runner;
use Ngmy\PhpinfoComparator\Domain\Model\Command\Input\{
    Url,
    Path,
    HttpInput,
    HtmlFileInput,
    TextFileInput
};
use Ngmy\PhpinfoComparator\Domain\Model\Command\Output\HtmlConsoleOutput;
use Ngmy\PhpinfoComparator\Infrastructure\{
    HtmlConsoleOutputGenerator,
    HttpPhpinfoFetcher,
    HtmlFilePhpinfoFetcher,
    TextFilePhpinfoFetcher
};
use Ngmy\PhpinfoComparator\Infrastructure\Library\Http\CurlHttpRequest;
use cogpowered\FineDiff\{
    Granularity\Word,
    Diff
};

class ContainerFactory
{
    public static function create(): Container
    {
        $builder = new ContainerBuilder();
        $container = $builder->newInstance();

        $container->params[CurlHttpRequest::class]['url'] = $container->lazyValue('fetch_url');
        $container->params[CurlHttpRequest::class]['options'] = $container->lazyValue('fetch_options');
        $container->params[HttpPhpinfoFetcher::class]['request'] = $container->lazyNew(CurlHttpRequest::class);
        $container->params[HttpInput::class]['url'] = $container->lazyNew(Url::class, ['value' => $container->lazyValue('input_url')]);
        $container->setters[HttpInput::class]['setFetcher'] = $container->lazyNew(HttpPhpinfoFetcher::class);

        $container->params[HtmlFilePhpinfoFetcher::class]['path'] = $container->lazyNew(Path::class, ['value' => $container->lazyValue('fetch_path')]);
        $container->params[HtmlFileInput::class]['path'] = $container->lazyNew(Path::class, ['value' => $container->lazyValue('input_path')]);
        $container->setters[HtmlFileInput::class]['setFetcher'] = $container->lazyNew(HtmlFilePhpinfoFetcher::class);

        $container->params[TextFilePhpinfoFetcher::class]['path'] = $container->lazyNew(Path::class, ['value' => $container->lazyValue('fetch_path')]);
        $container->params[TextFileInput::class]['path'] = $container->lazyNew(Path::class, ['value' => $container->lazyValue('input_path')]);
        $container->setters[TextFileInput::class]['setFetcher'] = $container->lazyNew(TextFilePhpinfoFetcher::class);

        $granularity = new Word();
        $diff = new Diff($granularity);
        $outputGenerator = new HtmlConsoleOutputGenerator($diff);
        $container->setters[HtmlConsoleOutput::class]['setGenerator'] = $outputGenerator;

        return $container;
    }
}
