<?php
declare(strict_types=1);

namespace Ngmy\PhpinfoComparator\Infrastructure;

use Ngmy\PhpinfoComparator\Domain\Model\Command\Output\OutputGeneratorInterface;
use Ngmy\PhpinfoComparator\Domain\Model\Phpinfo\PhpinfoPair;
use cogpowered\FineDiff\Diff;

class HtmlConsoleOutputGenerator implements OutputGeneratorInterface
{
    private $diff;

    public function __construct(Diff $diff)
    {
        $this->diff = $diff;
    }

    public function generate(PhpinfoPair $phpinfoPair): void
    {
        ob_start();
        $this->printHeader($phpinfoPair);

        echo $phpinfoPair->toDiffHtml($this->diff);

        $this->printFooter();

        $content = ob_get_contents();
        ob_end_clean();

        echo $content;
    }

    private function printHeader(PhpinfoPair $phpinfoPair): void
    {
        echo <<<HTML
<html>
<head>
<meta charset="UTF-8">
<title>PhpinfoComparator</title>
<style>
ins {
text-decoration: none;
background-color: #d4fcbc;
}
del {
text-decoration: none;
background-color: #fbb6c2;
color: #555;
}
</style>
</head>
<body>
<h1>Compare Two phpinfo() Files</h1>
<p>Comparison between {$phpinfoPair->toPhpinfoNamesHtml()}</p>
<h2>side-by-side comparison</h2>
HTML;
    }

    private function printFooter()
    {
        echo <<<HTML
</body>
</html>
HTML;
    }
}
