<?php

namespace App\Http\Controllers;

use App\FriendRequest;
use App\Notification;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    /**
     * @param Request $request
     * @param Response $response
     * @return int
     */
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

        $notification = new Notification();

        $notification_data = [
            'user_id' => $request->receive_user_id,
            'send_user_id' => Auth::user()->id,
            'title' => '仲間へのお誘いが来ました',
            'message' => $request->message,
            'type' => 'request'
        ];

        $notification ->fill($notification_data)->save();


        return $response->status();
    }

    public function createNotification() {

    }

}
