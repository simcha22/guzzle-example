<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserConfirmation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (
            $request->user_name == $request->user()->user_name &&
            $request->user()->password == md5($request->user_name . $request->password)
        ) {
            return $next($request);
        } else {
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
    }
}
