<?php
declare(strict_types=1);

namespace Ngmy\PhpinfoComparator\Infrastructure\Library\Http;

interface HttpRequestInterface
{
    public function setOption($name, $value): void;

    public function execute(): ?string;

    public function getInfo(): array;

    public function getError(): ?string;

    public function getErrorCode(): ?int;

    public function close(): void;
}
