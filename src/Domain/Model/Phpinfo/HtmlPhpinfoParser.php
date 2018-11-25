<?php
declare(strict_types=1);

namespace Ngmy\PhpinfoComparator\Domain\Model\Phpinfo;

use Ngmy\PhpinfoComparator\Domain\Model\Phpinfo\Data\{
    Data,
    Datum,
    Name,
    Value
};

class HtmlPhpinfoParser implements PhpinfoParserInterface
{
    private $html;

    public function __construct(string $html)
    {
        $this->html = $html;
    }

    public function parse(): Data
    {
        $data = [];
        $matches = [];
        if (preg_match_all('/<tr><td class="e">(.*?)<\/td><td class="v">(.*?)<\/td>(:?<td class="v">(.*?)<\/td>)?<\/tr>/', $this->html, $matches, PREG_SET_ORDER)) {
            foreach ($matches as $match) {
                $name  = trim($match[1]);
                $value = trim($match[2]);
                $value = strip_tags($value);
                $data[] = new Datum(
                    Name::createFromHtml($name),
                    Value::createFromHtml($value)
                );
            }
        }
        return new Data($data);
    }
}
