<?php
declare(strict_types=1);

namespace Ngmy\PhpinfoComparator\Domain\Model\Phpinfo;

use Ngmy\PhpinfoComparator\Domain\Model\Phpinfo\{
    Phpinfo,
    Data\Name,
    Data\Value
};
use cogpowered\FineDiff\Diff;

class PhpinfoPair
{
    private $phpinfo1;

    private $phpinfo2;

    public function __construct(Phpinfo $phpinfo1, Phpinfo $phpinfo2)
    {
        $this->phpinfo1 = $phpinfo1;
        $this->phpinfo2 = $phpinfo2;
    }

    public function toPhpinfoNamesHtml(): string
    {
        return '<span style="color:red;">' . $this->phpinfo1->name()->value() . '</span> and <span style="color:blue;">' . $this->phpinfo2->name()->value() . '</span>';
    }

    public function toDiffHtml(Diff $diff): string
    {
        $out = '';
        foreach ($this->uniqueNames() as $name) {
            $datum1 = $this->phpinfo1->data()->get($name);
            $datum2 = $this->phpinfo2->data()->get($name);
            $value1 = is_null($datum1) ? Value::createEmpty() : $datum1->value();
            $value2 = is_null($datum2) ? Value::createEmpty() : $datum2->value();
            $out .= $name->toHtml() . PHP_EOL;
            $out .= $value1->toHtml('value1') . PHP_EOL;
            $out .= $value2->toHtml('value2') . PHP_EOL;
            if (!$value1->equals($value2)) {
                $out .= '<span style="text-decoration:underline;">diff</span><br>' . PHP_EOL;
                $out .= $diff->render($value1->value(), $value2->value()) . '<br>' . PHP_EOL;
            }
            $out .= '<br>' . PHP_EOL;
        }
        return $out;
    }

    public function uniqueNames(): array
    {
        $nameHash = [];
        foreach ([$this->phpinfo1->data()->names(), $this->phpinfo2->data()->names()] as $names) {
            foreach ($names as $name) {
                $nameHash[$name->value()] = null;
            }
        }
        return array_map(function (string $name) {
            return new Name($name);
        }, array_keys($nameHash));
    }
}
