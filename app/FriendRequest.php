<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FriendRequest extends Model
{
    protected $fillable = [
        'send_user_id', 'receive_user_id', 'message', 'accept_status'
    ];
}
