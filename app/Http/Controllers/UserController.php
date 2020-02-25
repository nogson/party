<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{


    /**
     * @param Request $request
     * @param Response $response
     * @return array
     */
    public function users(Request $request, Response $response)
    {
        $users = User::where('id', '!=', Auth::user()->id)->get();
        $users = $users->map(function ($user) {
            $profile = $user->profile;
            $profile['skill'] = $user->skill;
            $profile['twitter_id'] = $user->twitter_id;
            $profile['requested'] =isset($user->friendRequest);
            return $profile;
        });


        return $users;
    }
}
