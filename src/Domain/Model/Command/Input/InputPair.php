<?php
declare(strict_types=1);

namespace Ngmy\PhpinfoComparator\Domain\Model\Command\Input;

use Ngmy\PhpinfoComparator\Domain\Model\Command\Input\AbstractInput;
use Ngmy\PhpinfoComparator\Domain\Model\Phpinfo\PhpinfoPair;

class InputPair
{
    private $input1;

    private $input2;

    public function __construct(AbstractInput $input1, AbstractInput $input2)
    {
        $this->input1 = $input1;
        $this->input2 = $input2;
    }

    public function fetch(): PhpinfoPair
    {
        $phpinfo1 = $this->input1->fetcher()->fetch();
        $phpinfo2 = $this->input2->fetcher()->fetch();

        return new PhpinfoPair($phpinfo1, $phpinfo2);
    }
}
