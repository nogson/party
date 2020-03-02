<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
       'user_id', 'send_user_id','title', 'type', 'message'
    ];
}
