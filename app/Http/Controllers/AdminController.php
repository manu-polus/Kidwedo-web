<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\dealer;
use App\User;
use App\UserRoles;
use App\Event;
use App\CreditExchange;
use Mail;

class AdminController extends Controller
{
    public function usersLoad()
    {
        $data['users_list']=DB::table('users')
        ->join('user_roles', 'users.id', '=', 'user_roles.user_id')
        ->where('user_role_type_id', '=', '3')
        ->get();
        return view('admin.users_list',$data);
    }

    public function editUser(Request $request)
    {
        $this->validate($request,[
            'id' => 'required',
            'name' => 'required',
            'contact' => 'required'
        ]);

        $user=new User();
        $update_user=$user->editUserConfirm($request);
        
        if($update_user)
        {
            return redirect()->route('users_list');
        }
    }

    public function deleteUser($id)
    {
        User::where('id',$id)->delete();
        return redirect()->route('users_list');
    }

    public function loadActiveDealers()
    {
        $data['dealer_list'] = DB::table('users')
        ->join('dealers', 'users.id', '=', 'dealers.user_id')
        ->join('user_roles', 'users.id', '=', 'user_roles.user_id')
        ->where([
            ['status_id', '=', '1'],
            ['user_role_type_id', '=', '2']
            ])
        ->get();
        
        return view('admin.admin_home',$data);
    }

    public function loadWaitingDealers()
    {
        $data['dealer_list'] = DB::table('users')
        ->join('dealers', 'users.id', '=', 'dealers.user_id')
        ->join('user_roles', 'users.id', '=', 'user_roles.user_id')
        ->where([
            ['status_id', '=', '2'],
            ['user_role_type_id', '=', '2']
            ])
        ->get();
        
        return view('admin.admin_home',$data);
    }

    public function loadBlockedDealers()
    {
        $data['dealer_list'] = DB::table('users')
        ->join('dealers', 'users.id', '=', 'dealers.user_id')
        ->join('user_roles', 'users.id', '=', 'user_roles.user_id')
        ->where([
            ['status_id', '=', '3'],
            ['user_role_type_id', '=', '2']
            ])
        ->get();
        
        return view('admin.admin_home',$data);
    }

    public function editDealer(Request $request)
    {
        $this->validate($request,[
            'id' => 'required',
            'address' => 'min:5',
            'zipcode' => 'required',
            'contact' => 'required',
            'about' => 'required|min:5',
            'name' => 'required',
            'business_name' => 'required',
        ]);
        
        $dealer = new dealer();
        $dealer_update = $dealer->updateDealerModel($request);
        if(session('route_type')==0)
            {
                session()->forget('route_type');
                return redirect()->route('awaitingdealers');
            }
            if(session('route_type')==1)
            {
                session()->forget('route_type');
                return redirect()->route('adminhome');
            }
            if(session('route_type')==2)
            {
                session()->forget('route_type');
                return redirect()->route('blockeddealers');
            }
    }

    public function acceptDealer($id)
    {

        $user = User::where('id',$id)->first();
        $user->status_id = 1;
        if($user->update())
        {
            Mail::send('mail.provider_approved', ['provider' => $user], function ($m) use ($user) {
                $m->from('hello@kidwedo.de', 'Kidwedo');
                $m->to($user->email, $user->name)->subject('Genehmigung als Anbieter');
            });

            if(session('route_type')==0)
            {
                session()->forget('route_type');
                return redirect()->route('awaitingdealers');
            }
            if(session('route_type')==2)
            {
                session()->forget('route_type');
                return redirect()->route('blockeddealers');
            }
        }
    }

    public function blockDealer($id)
    {
        $user = User::where('id',$id)->first();
        $user->status_id = 3;
        if($user->update())
        {
            if(session('route_type')==0)
            {
                session()->forget('route_type');
                return redirect()->route('awaitingdealers');
            }
            if(session('route_type')==1)
            {
                session()->forget('route_type');
                return redirect()->route('adminhome');
            }
        }
    }

    public function deleteDealer($id)
    {
        $user = User::where('id',$id)->delete();
        $dealer = dealer::where('user_id',$id)->delete();
        if(($user)&&($dealer))
        {
            if(session('route_type')==0)
            {
                session()->forget('route_type');
                return redirect()->route('awaitingdealers');
            }
            if(session('route_type')==1)
            {
                session()->forget('route_type');
                return redirect()->route('adminhome');
            }
            if(session('route_type')==2)
            {
                session()->forget('route_type');
                return redirect()->route('blockeddealers');
            }
        }
    }

    public function dealerHome()
    {
        $data['dealer_list'] = User::join(
            'dealers', 'users.id', '=', 'dealers.user_id')
            ->where([
            ['status_id', '=', '1'],
            ['user_type', '=', '1']
            ])->get();
        //dd($data);
       return view('admin.admin_home',$data);
    }
    
    public function loadPendingEvents()
    {
        $data['pending_events'] = DB::table('events AS e')
                                ->join('dealers AS d','d.id', '=', 'e.dealer_id')
                                ->select('d.*','e.*','e.id AS event_id','e.created_at AS event_created_date','e.updated_at AS event_updated_date')
                                ->where('event_status','=','Pending')
                                ->get();
                                
        return view('admin.pending_event_list',$data);
    }

    public function loadActiveEvents()
    {
        $data['active_events'] = DB::table('events AS e')
                                ->join('dealers AS d','d.id', '=', 'e.dealer_id')
                                ->select('d.*','e.*','e.id AS event_id','e.created_at AS event_created_date','e.updated_at AS event_updated_date')
                                ->where('event_status','=','Active')
                                ->get();
                                
        return view('admin.active_event_list',$data);
    }

    public function approvePendingEvent($id)
    {
        $event = Event::where('id','=',$id)->first();
        $event->event_status = "Active";

        if($event->update())
        {
            return redirect()->route('pending_events_list');
        }
    }

    public function changePassword()
    {
        return view('admin.change_password');
    }

    public function confirmChangePassword(Request $request)
    { 
        $this->validate($request,[
            'new_password' => 'confirmed|required',
        ]);
        if(Hash::check($request->input('password'), Auth::user()->password))
        {
            $user = User::where('id',Auth::user()->id)->first();
            $user->password = Hash::make($request->input('new_password'));
            if($user->update())
            {
                \Session::put('success', 'Neues Passwort registriert. Bitte melde dich mit deinem neuen Passwort an');
                Auth::logout();
                return redirect()->route('login');
            }
        }
        else
        {
            return redirect()->back()->with("message", "Ihr Passwort stimmt nicht mit Ihrem Konto überein!");
        }
    }

    public function loadCreditRatePage()
    {
        $data['exchange_rate'] = CreditExchange::find(1);
        return view('admin.credit_exchange',$data);
    }
    public function updateCreditRate(Request $request)
    {
        $this->validate($request,[
            'credit' => 'required|regex:/^\d*(\.\d{1,2})?$/',
            'euro' => 'required|regex:/^\d*(\.\d{1,2})?$/'
        ]);

        $exchange_rate_model = CreditExchange::find(1);
        if($exchange_rate_model == null)
        {
            $exchange_rate = new CreditExchange();
            $exchange_rate->credit_point = $request->input('credit');
            $exchange_rate->credit_euro = $request->input('euro');
        
            if($exchange_rate->save())
            {
                return redirect()->back()->with('exchange_message','Neuer Wechselkurs wurde gespeichert!');
            }
        }
        else
        {
            $exchange_rate_model->credit_point = $request->input('credit');
            $exchange_rate_model->credit_euro = $request->input('euro');
        
            if($exchange_rate_model->update())
            {
                return redirect()->back()->with('exchange_message','Neuer Wechselkurs wurde aktualisiert!');
            }
        }
        
    }
}
