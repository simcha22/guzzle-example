<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Traits\ApiResponser;

class LoginController extends Controller
{
    use ApiResponser;

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
            return $this->rejected($request->ip(), 200);
        }

        // Check user group
        $group = DB::table('pa_user_to_groups')->select('ug_id')->where('u_id', $user->id)->first();

        $token = $user->createToken('myapptoken')->plainTextToken;

        return $this->successLogin($request->ip(), $user, $token, $group, 201);

    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->successLogout($request->ip(), 200);

    }
}
