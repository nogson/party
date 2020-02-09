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
            return [
                'user'         => $user,
                'access_token' => $user->createToken(null, ['*'])->accessToken,
            ];
        }

        $user->name = $socialUser->getNickname();
        $user->email = $socialUser->getEmail();
        $user->avatar = $socialUser->getAvatar();
        $user->twitter_id = $socialUser->getId();
        $user->provider = 'twitter';

        $user->save();

        Auth::login($user);

        return [
            'user'         => $user,
            'access_token' => $user->createToken(null, ['*'])->accessToken,
        ];

    }

    public function tokenDestroy()
    {

        if(Auth::check()){
            return Auth::user()->OauthAccessToken()->delete();
        }
    }

}
