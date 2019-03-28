<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class dealer extends Model
{
    protected $fillable = [
        'business_name', 'description', 'zipcode', 'status_id', 'user_id', 'website'
    ];
    public function insertDealerModel($request)
    {
        $insert = new dealer();
        $insert->business_name = $request->input('business_name');
        $insert->description = $request->input('about');
        $insert->zipcode = $request->input('zipcode');
        $insert->status_id = 0;
        if($insert->save())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function updateDealerModel($request)
    {
        $id = $request->input('id');
        $insert_dealer = dealer::where('user_id',$id)->first();
        $insert_dealer->description = $request->input('about');
        $insert_dealer->website = $request->input('website');
        $insert_dealer->zipcode = $request->input('zipcode');
        $insert_dealer->business_name = $request->input('business_name');
        

        $insert_user = User::where('id',$id)->first();
        //$insert_user->email = $request->input('email');
        $insert_user->mobile_number = $request->input('contact');
        $insert_user->name = $request->input('name');
        $insert_user->address = $request->input('address');
        

        if(($insert_dealer->update()) && ($insert_user->update()))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
