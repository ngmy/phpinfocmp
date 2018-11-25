<?php
declare(strict_types=1);

namespace Ngmy\PhpinfoComparator\Domain\Model\Phpinfo;

use Ngmy\PhpinfoComparator\Domain\Model\Phpinfo\Data\{
    Data,
    Datum,
    Name,
    Value
};

class TextPhpinfoParser implements PhpinfoParserInterface
{
    private $text;

    public function __construct($text)
    {
        $this->text = $text;
    }

    public function parse(): Data
    {
        $data = [];
        $matches = [];
        if (preg_match_all('/(.*)=>(.*)/', $this->text, $matches, PREG_SET_ORDER)) {
            foreach ($matches as $match) {
                $name  = trim($match[1]);
                $value = trim($match[2]);
                $value = strip_tags($value);
                if (preg_match('/(.*)=>(.*)/', $name, $matches2)) {
                    $name = trim($matches2[1]);
                }
                if (preg_match('/^\$_SERVER\[\'(.*)\']/', $name, $matches2)) {
                    $name = '_SERVER["'. $matches2[1] . '"]';
                }
                $data[] = new Datum(
                    new Name($name),
                    Value::createFromText($value)
                );
            }
        }
        return new Data($data);
    }
}
