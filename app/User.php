<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'last_name', 'email', 'mobile_number', 'password', 'plan_id', 'status_id', 'address'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function editUserConfirm($request)
    {
        $user=User::find($request->input('id'));
        $user->name=$request->input('name');
        $user->last_name=$request->input('surname');
        $user->mobile_number=$request->input('contact');
        $user->address=$request->input('address');

        if($user->update())
        {
            return true;
        }
        else
        {
            return false;
        }             
    }
}
