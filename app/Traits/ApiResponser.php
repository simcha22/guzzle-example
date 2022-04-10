<?php

namespace app\Traits;

    trait ApiResponser
    {
        protected function rejected($ip, $code){
            return response()->json([
                'clientAddress' => $ip,
                'message' => "Invalid Username or password",
                'otpEnabled' => null,
                'phone' => null,
                'result' => "REJECTED",
                'userGroupId' => null,
                'userId' => 0,
                'userLevel' => null,
                'userType' => null,
                'username' => null,
            ], $code);
        }

        protected function successLogin($ip, $user, $token, $group, $code){

            return response()->json([
                'clientAddress' => $ip,
                'message' => null,
                'otpEnabled' => $user->otp_enabled,
                'phone' => $user->phone_number,
                'result' => "SUCCESS",
                'userGroupId' => $group->ug_id,
                'userId' => $user->id,
                'userLevel' => $user->user_type,
                'userType' => $user->user_type,
                'username' => $user->user_name,
                'token' => $token
            ], $code);
        }

        protected function successLogout($ip, $code){

            return response()->json([
                'clientAddress' => $ip,
                'message' => null,
                'result' => "SUCCESS",
            ], $code);

        }
    }
