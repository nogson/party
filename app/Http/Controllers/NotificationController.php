<?php

namespace App\Http\Controllers;

use App\FriendRequest;
use App\Notification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    //
    public function index()
    {
        $notifications = [];
//        $notification = new Notification();
        $items = Notification::where('user_id', Auth::user()->id)->get();

        for ($i = 0, $size = count($items); $i < $size; ++$i) {
            $item = FriendRequest::where('id', $items[$i]['notification_id'])->first();
            if ($items[$i]['type'] === 'request') {
                if ($item->accept_status === 0) {
                    $user = User::where('id', $item->send_user_id)->first();
                    $notification = [
                        'user' => $user,
                        'message' => $item->message,
                        'type' => $items[$i]['type']
                    ];

                    array_push($notifications, $notification);
                }
            } else if ($items[$i]['type'] === 'accept_request') {
                $user = User::where('id', $item->receive_user_id)->first();
                $notification = [
                    'user' => $user,
                    'message' => $item->message,
                    'type' => $items[$i]['type']
                ];

                array_push($notifications, $notification);
            }

        }


        return ['notifications' => $notifications];
    }
}
