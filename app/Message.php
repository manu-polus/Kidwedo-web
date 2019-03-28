<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'from_user_id', 'to_user_id', 'subject', 'message', 'parent_id', 'IsReadMessage', 'IsUserDeleted', 'IsProviderDeleted'
    ];
}
