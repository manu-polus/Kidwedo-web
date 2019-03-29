<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\dealer;
use App\UserRoles;
use Mail;

class GuestController extends Controller
{
    public function insertDealer(Request $request)
    {
        $this->validate($request,[
            'business_name' => 'required|min:3',
            'email' => 'required|unique:dealers',
            'address' => 'required|min:5',
            'contact' => 'required|min:6',
            'about' => 'required|min:5',
            'zipcode' => 'required|integer'
        ]);
        $dealer = new dealer();
        $dealer_insert = $dealer->insertDealerModel($request);
        if($dealer_insert)
        {
            session(['success' => 'Successfully Registered! We will contact you for confirmation!']);
            return redirect()->route('plans');
        }
        else
        {
            session(['error' => 'Failed to Register. Try again by avoiding any special character on input fields!']);
            return redirect()->route('plans');
        }
    }

    public function loadPrivateProvider()
    {
        $data['template'] = $this->getTemplate();
        return view('private_provider',$data);
    }
    public function loadCommercialProvider()
    {
        $data['template'] = $this->getTemplate();
        return view('commercial_provider',$data);
    }
    public function loadOurTeam()
    {
        $data['template'] = $this->getTemplate();
        return view('our_team',$data);
    }
    public function loadPrivacyPolicy()
    {
        $data['template'] = $this->getTemplate();
        return view('privacy_policy',$data);
    }
    public function loadCareer()
    {
        $data['template'] = $this->getTemplate();
        return view('jobs',$data);
    }
    public function loadCareerLists()
    {
        $data['template'] = $this->getTemplate();
        return view('job_listing',$data);
    }
    public function loadJob()
    {
        $data['template'] = $this->getTemplate();
        return view('job_description',$data);
    }
    public function loadAboutUs()
    {
        $data['template'] = $this->getTemplate();
        return view('about',$data);
    }
    public function loadContactUs()
    {
        $data['template'] = $this->getTemplate();
        return view('contact_us',$data);
    }
    public function loadImprint()
    {
        $data['template'] = $this->getTemplate();
        return view('imprint',$data);
    }
    public function getTemplate()
    {
        if(Auth::user() != null)
        {
            $user = UserRoles::where('user_id','=',Auth::user()->id)->first();

            if($user->user_role_type_id == 3)
                return 'layouts.template';
                
            if($user->user_role_type_id == 2)
	            return 'layouts.partner';
        }
        return 'layouts.template';
    }
    public function postContactUs(Request $request)
    {

        /*$this->validate($request,[
            'subject' => 'required|min:4',
            'message' => 'required|min:5',
            'email' => 'required|email'
        ]);*/

        $user['email'] = $request->input('email');
        $user['name'] = $request->input('name');
        $user['subject'] = $request->input('name');
        
        $mail_data['message'] = $request->input('message');


        Mail::send('mail.activity_booked', $mail_data, function ($m) use ($user) {
            $m->from($user['email'], 'Kidwedo');
            $m->to('hello@kidwedo.de', $user['name'])->subject($user['subject']);
        });
    }
}
