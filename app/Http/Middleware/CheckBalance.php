<?php

namespace App\Http\Middleware;

use App\Repositories\OperationRepository;
use Closure;
use Illuminate\Http\Request;

class CheckBalance
{
    public function __construct(OperationRepository $operation)
    {
        $this->operation = $operation;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */


    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->balance <= 0) {
            return response()->json([
                'errors' => [
                    ['title' => 'insufficient-balance']
                ]
            ], 400); 
        }
  
        return $next($request);
    }
}
