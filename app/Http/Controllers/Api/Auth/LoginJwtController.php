<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginJwtController extends Controller
{
    public function login(Request $request)
    {

        $credentials = $request->all(['email', 'password']);

        Validator::make($credentials,[
            'email' => 'required|string',
            'password' => 'required|string'
        ])->validate();

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json([
            'token' => $token
        ]);
    }

    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => 'Logout Successfully !'], 200);
    }

    public function refresh()
    {
        $token = auth('api')->refresh();

        return response()->json([
            'token' => $token
        ]);
    }
}
