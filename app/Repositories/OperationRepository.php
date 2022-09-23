<?php

namespace App\Repositories;

use App\Models\Operation;

class OperationRepository
{
    public function __construct(Operation $operation)
    {
        $this->operation = $operation;
    }

    public function typeExists(string $type) : bool
    {
        return $this->operation->where('type', $type)->exists();
    }

    public function returnCostFromType(string $type) : int
    {
        return $this->operation->where('type', $type)->select('cost')->first()->cost;
    }
}
