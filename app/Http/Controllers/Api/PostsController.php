<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    public function index()
    {
        //return (Auth::user());

        return DB::select("SELECT t1.SCREEN_NAME , t1.PERMISSIONS_LEVEL , t1.GRID_VIEW 
        FROM T_ADM_PROFILE_SCREEN_CONFIG t1, t_adm_profile_screen_base t2
        WHERE PROFILE_ID IN
        (SELECT PROFILE_ID FROM T_ADM_PROFILE_TO_UG_ID WHERE UG_ID IN 
          (SELECT UG_ID FROM PA_USER_TO_GROUPS WHERE U_ID IN 
            (SELECT ID FROM PA_USERS WHERE USER_NAME = 'simcha' )))
        and upper(t1.MODULE_NAME)='ACCESS'
        and t1.screen_name = t2.screen_name and t1.module_name = t2.module_name
        order by t2.screen_id");
        // return Post::all();
    }
}
