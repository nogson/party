<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
       'user_id', 'notification_id','type', 'read_state'
    ];
}
