<?php

namespace App\Services;

use App\Repositories\OperationRepository;

class AdditionService
{
    private $value1;
    private $value2;

    public function __construct(
        int $value1,
        int $value2,
    )
    {
        $this->value1 = $value1;
        $this->value2 = $value2;
    }

    public function getResult(): int
    {
        return $this->value1 + $this->value2;
    }
}
