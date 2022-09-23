<?php

namespace App\Services;

use App\Repositories\OperationRepository;

class CalculatorService
{
    public function __construct(
        OperationRepository $operationRepository
    )
    {
        $this->operationRepository = $operationRepository;
    }

    public function performOperation(
        string $type,
        ?string $value1,
        ?string $value2,
    )
    {
        if (!$this->operationRepository->typeExists($type)) {
            throw new \Exception("type-not-exists", 404);
        }

        if (auth()->user()->balance < $this->operationRepository->returnCostFromType($type)) {
            throw new \Exception("insufficient-balance", 400);
        }

        $operation = match ($type) {
            'addition' => new AdditionService($value1, $value2),
        };

        return $operation->getResult();
    }
}
