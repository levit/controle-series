<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $resquest)
    {
        $credencials = $resquest->only(['email','password']);
        $autotizado = Auth::attempt(['email' => $credencials['email'], 'password' => $credencials['password']]);

        if (!$autotizado) {
            return response()->json('Unauthorized', 401);
        }

        $user = Auth::user();
        $user->tokens()->delete();
        $token = $user->createToken('token');
        //$token = $user->createToken('token', ['series:delete']);

        return response()->json($token->plainTextToken);
    }

}
