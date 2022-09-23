<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Services\CalculatorService;
use Illuminate\Http\Request;

class CalculatorController extends Controller
{   
    public function __invoke(
        Request $request, 
        CalculatorService $service
    )
    {
        return $this->performOperation($request, $service);
    }

    private function performOperation(
        Request $request, 
        CalculatorService $service
    )
    {
        try {
            $result = $service->performOperation(
                $request->type,
                $request->value1,
                $request->value2,
            );
        } catch (\TypeError $e) {
            return response()->json(['errors' => [['title' => 'invalid-data-type']]], 400); 
        } catch(\Exception $e){
            return response()->json(['errors' => [['title' => $e->getMessage()]]], $e->getCode()); 
        }

        return response()->json(['result' => $result], 200); 
    }
}
