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
            ->where('blocked', '0')
            ->first();

        //$user = DB::select("select * from pa.pa_users where password = (select md5('" . $request->user_name . $request->password . "'))");

        if (!$user) {
            return response()->json([
                'clientAddress' => $request->ip(),
                'message' => "Invalid Username or password",
                'otpEnabled' => null,
                'phone' => null,
                'result' => "REJECTED",
                'userGroupId' => null,
                'userId' => 0,
                'userLevel' => null,
                'userType' => null,
                'username' => null,
            ], 200);
        }

        // Check user group
        $group = DB::table('pa_user_to_groups')->select('ug_id')->where('u_id', $user->id)->first();

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'clientAddress' => $request->ip(),
            'message' => null,
            'otpEnabled' => $user->otp_enabled,
            'phone' => $user->phone_number,
            'result' => "SUCCESS",
            'userGroupId' => $group->ug_id,
            'userId' => $user->id,
            'userLevel' => $user->user_type,
            'userType' => $user->user_type,
            'username' => $user->user_name,
            //'user' => $user,
            'token' => $token
        ];

        return response()->json($response, 201);
    }

    public function logout(Request $request)
    {

        $request->user()->currentAccessToken()->delete();
        $response = [
            'clientAddress' => $request->ip(),
            'message' => null,
            'result' => "SUCCESS",
        ];

        return response()->json($response, 200);
    }
}
