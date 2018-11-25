<?php
declare(strict_types=1);

namespace Ngmy\PhpinfoComparator\Infrastructure\Library\Http;

use Ngmy\PhpinfoComparator\Infrastructure\Library\Http\HttpRequestInterface;

class CurlHttpRequest implements HttpRequestInterface
{
    private $handler;

    public function __construct(string $url, array $options = [])
    {
        $this->handler = curl_init($url);
        $this->setOption(CURLOPT_HEADER, 0);
        $this->setOption(CURLOPT_RETURNTRANSFER, 1);
        foreach ($options as $name => $value) {
            $this->setOption($name, $value);
        }
    }

    public function setOption($name, $value): void
    {
        curl_setopt($this->handler, $name, $value);
    }

    public function execute(): ?string
    {
        $body = curl_exec($this->handler);
        return $body === false ? null : $body;
    }

    public function getInfo(): array
    {
        $info = curl_getinfo($this->handler);
        return $info === false ? [] : $info;
    }

    public function getError(): ?string
    {
        $error = curl_error($this->handler);
        return empty($error) ? null : $error;
    }

    public function getErrorCode(): ?int
    {
        $errorCode = curl_errno($this->handler);
        return $errorCode === false || $errorCode === 0 ? null : $errorCode;
    }

    public function close(): void
    {
        curl_close($this->handler);
    }
}
