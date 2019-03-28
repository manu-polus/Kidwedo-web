<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Redirect;
use App\payments;
use App\User;
use App\UserRoles;
use Session;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(Auth::user() != null)
            { 
                $user = Auth::user();
                $user_role = UserRoles::where('user_id','=',$user->id)->first();
                $payment=payments::where('payer_user_id',$user->id)
                        ->where('status','approved')
                        ->orderBy('id','desc')
                        ->first();
            $user_detail=User::where('email',$user->email)
                        ->first();
            if(($user_role->user_role_type_id == 3))
            {
                if($payment==null)
                {
                    //session(['error' => 'You have not completed your payment! Please complete your payment.']);
                }
                else
                {
                    //session(['error' => 'Your plan has been expired! Please Renew.']); 
                }
                //session(['username' => $user->user_id]);
                //Auth::logout();

                if($user->status_id==3)
                {
                    return redirect()->route('subscribe');
                }
                if($user->status_id==1)
                {
                    if(request()->is('/'))
                    {
                        return redirect()->route('landing');
                    }
                    return redirect()->route('activity');
                }
            }
            else
            {
                if($user_role->user_role_type_id == 1)
                {
                    return redirect()->route('adminhome');
                }
                if($user_role->user_role_type_id == 2)
                {
                    return redirect()->route('partnerhome');
                }
                $payment_date = $payment->created_at;
                $current_date = date('Y-m-d H:i:s');
                $payment_date = new \DateTime($payment_date);
                $current_date = new \DateTime($current_date);
                $interval = $payment_date->diff($current_date);
                if(($user_role->user_role_type_id == 3) && (($interval->m >= 3) || ($interval->y > 0)))
                {
                    $payment->status = "expired";
                    $payment->update();
                    $user_detail->status = 0;
                    $user_detail->update();
                    //session(['error' => 'Your 3 Months plan has been expired! Please Renew.']);
                    //session(['username' => $user->user_id]);
                    //Auth::logout();
                    return redirect()->route('plans');
                }
                if(($user_role->user_role_type_id == 3) && (($interval->m >= 6) || ($interval->y > 0)))
                {
                    $payment->status = "expired";
                    $payment->update();
                    $user_detail->status_id = 0;
                    $user_detail->update();
                    //session(['error' => 'Your 6 Months plan has been expired! Please Renew.']);
                    //session(['username' => $user->user_id]);
                    //Auth::logout();
                    return redirect()->route('plans');
                }
                if(($user_role->user_role_type_id == 3) && ($interval->y > 0))
                {
                    $payment->status = "expired";
                    $payment->update();
                    $user_detail->status_id = 0;
                    $user_detail->update();
                    //session(['error' => 'Your 1 Year plan has been expired! Please Renew.']);
                    //session(['username' => $user->user_id]);
                    //Auth::logout();
                    return redirect()->route('plans');
                }
            }
        }
            return $next($request);
        });
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    public function loginCheck()
    { 
        if(Auth::user() == null)
        {
            return view('landing');
        }
        else
        {
            if(Auth::user()->status_id == 1)
            {
                return view('landing');
            }
            return Redirect::to('/subscribe');
        }
    }
}
