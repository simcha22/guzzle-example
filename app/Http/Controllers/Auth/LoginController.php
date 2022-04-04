<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public  function store(LoginRequest $request)
    {

        //$user = User::where('user_name', $request->user_name)->first();

        // Check user and password
        $user = User::where('user_name', $request->user_name)
            ->where('password', md5($request->user_name . $request->password))
            ->first();
        //$user = DB::select("select * from pa.pa_users where password = (select md5('" . $request->user_name . $request->password . "'))");

        if (!$user) {
            return response([
                'message' => 'Bad creds'
            ], 401);
        } 

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout(Request $request) {

        $request->user()->currentAccessToken()->delete();
        return [
            'message' => 'Logged out'
        ];
    }
}
