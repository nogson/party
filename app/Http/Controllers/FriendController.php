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
        $friend_request = new FriendRequest();

        $data = [
            'send_user_id' => Auth::user()->id,
            'receive_user_id' => $request->receive_user_id,
            'message' => $request->message,
            'accept_status' => 0
        ];
        $friend_request->fill($data)->save();

        $notification = new Notification();

        $notification_data = [
            'user_id' => $request->receive_user_id,
            'notification_id' => $friend_request->id,
            'type' => 'request',
            'read_state' => 0
        ];

        $notification->fill($notification_data)->save();


        return $response->status();
    }

    public function acceptRequest(Request $request, Response $response)
    {
        $friend_request = FriendRequest::where('send_user_id', $request->user_id)->where('receive_user_id', Auth::user()->id)->first();

        if($friend_request->accept_status == 1){
            return $response;
        }

        $friend_request->accept_status = 1;
        $friend_request->save();

        $notification = new Notification();

        $notification_data = [
            'user_id' => $friend_request->send_user_id,
            'notification_id' => $friend_request->id,
            'type' => 'accept_request',
            'read_state' => 0
        ];

        $notification->fill($notification_data)->save();

        return $response;
    }

    public function createNotification()
    {

    }

}
