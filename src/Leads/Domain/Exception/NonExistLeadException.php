<?php
declare(strict_types=1);

namespace Cal\Leads\Domain\Exception;

class NonExistLeadException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Non exist lead', 0, null);
    }
}