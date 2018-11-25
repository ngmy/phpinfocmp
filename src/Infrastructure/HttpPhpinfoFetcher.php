<?php
declare(strict_types=1);

namespace Ngmy\PhpinfoComparator\Infrastructure;

use Ngmy\PhpinfoComparator\Domain\Model\Command\Input\Url;
use Ngmy\PhpinfoComparator\Domain\Model\Phpinfo\{
    PhpinfoFactory,
    Phpinfo,
    HtmlPhpinfoParser,
    PhpinfoFetcherInterface
};
use Ngmy\PhpinfoComparator\Infrastructure\Library\Http\HttpRequestInterface;
use RuntimeException;

class HttpPhpinfoFetcher implements PhpinfoFetcherInterface
{
    private $request;

    public function __construct(HttpRequestInterface $request)
    {
        $this->request = $request;
    }

    public function fetch(): Phpinfo
    {
        $body = $this->request->execute();
        $info = $this->request->getInfo();

        $error = $this->request->getError();
        $errno = $this->request->getErrorCode();

        $this->request->close();

        if (!is_null($error)) {
            throw new RuntimeException($error, $errno);
        }

        return PhpinfoFactory::create(
            $info['url'],
            new HtmlPhpinfoParser($body)
        );
    }
}
