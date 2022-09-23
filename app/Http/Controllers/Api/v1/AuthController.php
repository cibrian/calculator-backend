<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{   
    public function __invoke(
        Request $request, 
    )
    {
        return $this->login($request);
    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            return response()->json(
                [
                    'token' => $user->createToken('MyApp')->plainTextToken
                ]
            );
        } 
        else{ 
            return response()->json(['errors' => [['title' => 'invalid-credentials']]], 401);
        } 
    }
}
