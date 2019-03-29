<?php

namespace App\Http\Controllers\Auth;

use Mail;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\dealer;
use App\UserRoles;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = '/home';
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
    
        if($data['type'] == '2')
        {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'min:4'],
            'business_name' => ['required', 'string', 'min:4'], 
        ]);
        
        }
        
        if($data['type'] == '3')
        {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['max:15'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'min:4'],
            'password' => ['required', 'string', 'min:6'],
        ]);
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        if($data['type'] == '2')
        {
            $insert_data['name'] = $data['name'];
            $insert_data['last_name'] = 't';
            $insert_data['email'] = $data['email'];
            $insert_data['address'] = $data['address'];
            $insert_data['mobile_number'] = $data['phone'];
            $insert_data['status_id'] = 2;
            $insert_data['plan_id'] = '1';
            $insert_data['password'] = Hash::make($data['email']);

            $user = User::create( $insert_data );

            $role = new UserRoles();
            $role->user_id = $user->id;
            $role->user_role_type_id = $data['type'];
            $role->save();

            $dealer_data['business_name'] = $data['business_name'];
            $dealer_data['description'] = $data['about'];
            $dealer_data['zipcode'] = $data['zipcode'];
            $dealer_data['user_id'] = $user->id;
            $dealer_data['website'] = $data['website'];
            $partner = dealer::create( $dealer_data );

            Mail::send('mail.provider_registered', ['provider' => $user], function ($m) use ($user) {
                $m->from('hello@kidwedo.de', 'Kidwedo');
                $m->to($user->email, $user->name)->subject('Registrierungsbestätigung');
            });
            return $user;
            
        }
        if($data['type'] == '3')
        {
            $insert_data['name'] = $data['name'];
            $insert_data['last_name'] = $data['surname'];
            $insert_data['email'] = $data['email'];
            $insert_data['mobile_number'] = $data['phone'];
            $insert_data['status_id'] = 3;
            $insert_data['plan_id'] = '1';
            $insert_data['password'] = Hash::make($data['password']);
            //Insert user
            $user = User::create( $insert_data );

            $role = new UserRoles();
            $role->user_id = $user->id;
            $role->user_role_type_id = $data['type'];
            $role->save();

            Mail::send('mail.customer_registered', ['customer' => $user], function ($m) use ($user) {
                $m->from('hello@kidwedo.de', 'Kidwedo');
                $m->to($user->email, $user->name)->subject('Registrierungsbestätigung');
            });

            return $user;
        }
        
    }
}
