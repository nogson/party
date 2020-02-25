<?php

namespace App\Http\Controllers;

use App\FriendRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    //
    public function request(Request $request, Response $response)
    {
        $friendRequest = new FriendRequest();

        $data = [
            'send_user_id' => Auth::user()->id,
            'receive_user_id' => $request->receive_user_id,
            'message' => $request->message,
            'accept_status' => 0
        ];
        $friendRequest->fill($data)->save();
        return $response->status();


    }
}
