<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;




class TwitterController extends Controller
{
    public function getRedirectUrl()
    {
        $redirectUrl = Socialite::driver('twitter')->redirect()->getTargetUrl();

        return response()->json([
            'redirect_url' => $redirectUrl
        ]);
    }

    /**
     * Callback from Twitter
     * @return mixed
     */
    public function handleTwitterCallback()
    {

        //$socialUser = Socialite::driver('twitter')->user();

        $socialUser = Socialite::driver('twitter')->userFromTokenAndSecret(env('TWITTER_ACCESS_TOKEN'), env('TWITTER_ACCESS_TOKEN_SECRET'));
        $user = User::firstOrNew([
            'email' => $socialUser->getEmail()
        ]);


        if ($user->exists) {
            Auth::login($user);
            return response()->json($user);
        }

        $user->name = $socialUser->getNickname();
        $user->email = $socialUser->getEmail();
        $user->twitter_id = $socialUser->getId();

        $user->save();

        Auth::login($user);
        return response()->json($user);
    }
}
