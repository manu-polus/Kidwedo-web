<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\EventReview;
use Illuminate\Support\Facades\Redirect;
use App\User;
use Illuminate\Support\Facades\Crypt;
use PDF;

class ActivityController extends Controller
{
    public function activity()
    {
        $data['age_groups'] = DB::table('preferred_ages')->get();
        $data['categories'] = DB::table('category')->get();
        return view('user.activity', $data);
    }

    public function getActivity( Request $request )
    {
        /*$activities = DB::table('events AS e')
            ->leftJoin('dealers AS d', 'd.id', '=', 'e.id')
            ->leftJoin('preferred_ages AS a', 'a.id', '=', 'e.preferred_age_id')
            ->leftJoin('category AS c', 'c.id', '=', 'e.category_id')
            ->leftJoin('event_dates AS ed', 'ed.id', '=', 'e.id')
            ->select('e.id','e.event_name','e.dealer_id','d.business_name','e.preferred_age_id','a.description','e.category_id','c.description','ed.date','ed.from_time','ed.to_time','ed.total_seats','ed.seat_remaining','e.description','e.additional_description','e.city','e.credit','e.event_status','e.cancellation_policy','e.is_caregiver_needed','e.event_duration','e.location_longitude','e.location_latitude','e.created_at','e.updated_at')
            ->get();*/
            $request_json = $request->get("query");
            $query = "CALL GET_KWD_EVENTS_distance('". $request_json ."')";
            //echo $query;die;
            $data['activities'] = DB::select($query);
            //dd($data['activities']);
            if(json_decode($request_json)->type == "1")
                return view("user.api.calender-view", $data);
            else 
                return view("user.api.list-view", $data);
    }

    public function getProviderCalendarActivity( Request $request )
    {
        $request_json = $request->get("query");
        $list = json_decode($request_json); 
        $data['activities'] = DB::table('dealers AS d')
                                    ->join('users AS u','u.id','=','d.user_id')
                                    ->join('events AS e','e.dealer_id','=','d.id')
                                    ->join('event_dates AS ed','e.id','=','ed.event_id')
                                    ->join('preferred_ages AS p','e.preferred_age_id','=','p.id')
                                    ->join('category AS c','e.category_id','=','c.id')
                                    ->select('ed.id AS event_id','e.id AS event','e.event_name','e.city' ,'e.credit','p.description AS age_description','e.event_duration','d.business_name','c.description AS category','ed.from_time AS time','e.pic_filename AS event_picture')
                                    ->where('u.id','=',$list->user_id)
                                    ->where('ed.date','>=',$list->date)
                                    ->skip(0)
                                    ->take(10)
                                    ->orderBy('ed.date', 'asc')
                                    ->orderBy('ed.from_time', 'asc')
                                    ->get();
                                    //dd($data['activities']);
        $data['rating_avg_list'] = $this->processRatingList($data['activities']->unique('event'));
        //dd($rating_data);                           

        return view("user.api.provider-calendar-events",$data);
    }

    public function processRatingList($rating_data)
    {
        $average = [];
        $event_array = [];
        $review = null;

        foreach($rating_data as $rate)
        {
            if($rate->event)
            {
                $review = EventReview::where('event_id','=',$rate->event)->get();
                if(count($review) > 0)
                {
                    $event_array = [
                        'event_id' => $rate->event,
                        'rating' => round($review->avg('rating')),
                        'count' => count($review)
                    ];
                    array_push($average, $event_array);
                }
            }
        }
        return $average;
    }
    public function getActivityDetails($id)
    {
        $result = DB::table('events AS e')
                    ->join('dealers AS d','e.dealer_id','=','d.id')
                    ->join('event_dates AS ed','e.id','=','ed.event_id')
                    ->join('users AS u','d.user_id','=','u.id')
                    ->join('preferred_ages AS p','e.preferred_age_id','=','p.id')
                    ->select('u.id AS user_id','d.id AS deader_id','e.id AS event_id','event_name','p.description AS age','category_id','d.description AS dealer_description','e.description AS event_description','additional_description','city','credit','event_status','cancellation_policy','is_caregiver_needed','event_duration','e.location_longitude AS event_longitude','e.location_latitude AS event_latitude','d.location_longitude AS dealer_longitude','d.location_latitude AS dealer_latitude','pic_filename AS activity_pic','logo_pic_filename AS dealer_logo','main_pic_filename AS dealer_pic','d.user_id AS user_id','business_name','zipcode','website','editors_tip','date','from_time','to_time','total_seats','seat_remaining','address')
                    ->where('e.id','=',$id)
                    ->first();
        return $result;
    }
	
	public function providerActivity()
    {
        $data['age_groups'] = DB::table('preferred_ages')->get();
        $data['categories'] = DB::table('category')->get();
        $data['dealer_id'] = $this->getDealerIdFromUserId(Auth::user()->id);
        return view('partner.dashboard', $data);
    }

    public function getProviderDetails($id)
    {
        $result = DB::table('dealers AS d')
                    ->join('users AS u','d.user_id','=','u.id')
                    ->select('u.id AS user_id','d.id AS dealer_id','d.description AS dealer_description','d.location_longitude AS dealer_longitude','d.location_latitude AS dealer_latitude','logo_pic_filename AS dealer_logo','main_pic_filename AS dealer_pic','d.user_id AS user_id','business_name','zipcode','website','editors_tip','address')
                    ->where('d.user_id','=',$id)
                    ->first();
        return $result;
    }

    public function getProviderActivities($id)
    {
        $result = DB::table('dealers AS d')
                    ->join('users AS u','d.user_id','=','u.id')
                    ->select('d.id AS deader_id','d.description AS dealer_description','d.location_longitude AS dealer_longitude','d.location_latitude AS dealer_latitude','logo_pic_filename AS dealer_logo','main_pic_filename AS dealer_pic','d.user_id AS user_id','business_name','zipcode','website','editors_tip','address')
                    ->where('d.user_id','=',$id)
                    ->first();
        return $result;
    }

    // Get activity list for partner API
    public function getPartnerActivitiesAPI( Request $request )
    {
       // DB::enableQueryLog();
        $request_array = json_decode($request->get('query'));
        $query = DB::table('events')
                        ->join('dealers', 'dealers.id', '=', 'events.dealer_id')
                        ->join('category','category.id','=','events.category_id')
                        ->join('preferred_ages','preferred_ages.id','=','events.preferred_age_id')
                        ->select('events.*', 'dealers.business_name','preferred_ages.description AS age','category.description AS category','category.icon_file_name AS icon')
                        ->where('events.dealer_id', '=', $request_array->provider);
        if(is_array($request_array->age_group))
            $query->whereIn('events.preferred_age_id', $request_array->age_group);
        if(is_array($request_array->category_selected))
            $query->whereIn('events.category_id', $request_array->category_selected);    
        //dd($request_array);
        $result = $query->get();
        //dd(DB::getQueryLog());
        $data['events'] = $result;
        return view('partner.api.activity-view', $data);
        
    }

    public function getNextFiveActivities($dealer_id)
    {
        $mytime = Carbon::now();
        $date = $mytime->format("Y-m-d");
        $time = $mytime->format("H:i:s");

        $result = DB::table('event_dates AS ed')
        ->join('events AS e','e.id','=','ed.event_id')
        ->where('e.dealer_id','=',$dealer_id)
        ->where('ed.date','>=',$date)
        ->where('ed.from_time','>=',$time)
        ->skip(0)
        ->take(5)
        ->orderBy('ed.date', 'asc')
        ->orderBy('ed.from_time', 'asc')
        ->get();
        
        return $result;
    }

    public function getNextFiveActivitiesBasedEvent($event)
    {
        $mytime = Carbon::now();
        $date = $mytime->format("Y-m-d");
        $time = $mytime->format("H:i:s");
        $result = DB::table('event_dates AS ed')
        ->join('events AS e','e.id','=','ed.event_id')
        ->select('ed.*','e.*','ed.id AS event_date_id')
        ->where('e.id','=',$event)
        ->where('ed.date','>=',$date)
        //->where('ed.from_time','>=',$time)
        ->skip(0)
        ->take(5)
        ->orderBy('ed.date', 'asc')
        ->orderBy('ed.from_time', 'asc')
        ->get();
        
        return $result;
    }

    public function bookActivity($id)
    {
        $data['event_date'] = DB::table('event_dates')
                                ->where('id', $id)
                                ->first();
        $data['event'] = DB::table('events')
                                ->where('id', $data['event_date']->event_id)->first();
        $data['event_time'] = DB::table('event_dates')
                                ->where('date', '=', $data['event_date']->date)
                                ->where('event_id', '=', $data['event_date']->event_id)
                                ->where('seat_remaining', '>', '0')
                                ->get();
                               // dd($data['event_date']->date);
        return view('user.book-now', $data);
    }
    public function bookActivityInsert(Request $request)
    {
        $user_id = Auth::user()->id;
        $this->validate($request,[
            'accept_check' => 'required'
        ]);
       $slot = $request->input('time');
       $activity = DB::table('event_dates')
                        ->select('events.*', 'event_dates.id as event_date_id', 'date', 'from_time', 'to_time', 'total_seats', 'seat_remaining')
                        ->join('events', 'events.id', '=', 'event_dates.event_id')
                        ->where('event_dates.id', '=', $slot)
                        ->first();
                        
        if($activity->seat_remaining < 1) return Redirect::back()->withErrors('Keine Plätze verfügbar');
        $user_credits = User::where('id', '=', $user_id)
                    ->pluck('available_credits')
                    ->first();
        if($user_credits < $activity->credit) return Redirect::back()->withErrors("Sie haben kein ausreichendes Guthaben!");
        $credit_euro = DB::table('credit_euro_exchange_rate')->select('credit_point', 'credit_euro')->first();
        $euro_base_1 = (int)$credit_euro->credit_euro/(int)$credit_euro->credit_point;
        $purchase_id = DB::table('user_purchase')
                ->insertGetId([
                    'user_id' => $user_id,
                    'eventdate_plan_id' => $activity->event_date_id,
                    'purchase_type_code' => 2,
                    'purchase_status'=> 'Active',
                    'credits' => $activity->credit,
                    "created_at" =>  \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now()
                ]);
        $purchase_id = DB::table('dealer_purchase')
                ->insertGetId([
                    'dealer_id' => $activity->dealer_id,
                    'user_id' => $user_id,
                    'eventdate_id' => $activity->event_date_id,
                    'purchase_status'=> 'Active',
                    'credits' => $activity->credit,
                    'credits_in_euro' => $euro_base_1*$activity->credit,
                    "created_at" =>  \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now()
                ]);
        DB::table('users')
                ->where('id', $user_id)
                ->update([
                    'available_credits' => $user_credits - $activity->credit,
                ]);    
        DB::table('event_dates')
                ->where('id', $slot)
                ->update([
                    'seat_remaining' => $activity->seat_remaining - 1,
                ]);        
        $parameter =[
            'id' =>$purchase_id,
        ];  
        $provider_data = DB::table('dealers')
            ->where('id', '=', $activity->dealer_id)
            ->join('users','users.id', '=', 'dealers.user_id') 
            ->select('business_name', 'email')
            ->first();
        $mail_data['event_name'] = $activity->name;
        $mail_data['date'] = $activity->date;
        $mail_data['name'] = Auth::user()->name;
        $mail_data['provider_name'] = $provider_data->business_name;

        Mail::send('mail.activity_booked', $mail_data, function ($m) use ($user) {
            $m->from('hello@kidwedo.de', 'Kidwedo');
            $m->to($user->email, $user->name)->subject('Bestätigung Aktivitätsbuchung');
        });

        Mail::send('mail.customer_booked_activity', $mail_data, function ($m) use ($provider_data) {
            $m->from('hello@kidwedo.de', 'Kidwedo');
            $m->to($provider_data->email, $provider_data->business_name)->subject('Registrierungsbestätigung');
        });

        return redirect()->route('activity.booking.success', [Crypt::encrypt($parameter)]);
    }
    public function bookingSuccess($id)
    {
        $data['ticket_enc'] = $id;
        $id = Crypt::decrypt($id);
        
        $data['ticket_details'] = DB::table('purchases')
                            ->select('purchases.id as ticket_id', 'event_dates.date', 'event_dates.from_time', 'events.event_name')
                            ->join('event_dates', 'event_dates.id', '=', 'purchases.event_plan_id')
                            ->join('events', 'events.id', '=', 'event_dates.event_id')
                            ->where('purchases.id', '=', $id)
                            ->first();
        return view('user.booking-success', $data);
    }
    public function printTicket($id)
    {
        $id = Crypt::decrypt($id);
        $data['ticket_details'] = DB::table('purchases')
                            ->select('purchases.id as ticket_id', 'event_dates.date', 'event_dates.from_time', 'events.event_name')
                            ->join('event_dates', 'event_dates.id', '=', 'purchases.event_plan_id')
                            ->join('events', 'events.id', '=', 'event_dates.event_id')
                            ->where('purchases.id', '=', $id)
                            ->first();
        return view('user.print-ticket', $data);
    }

    public function bookedActivity()
    {
        $data['age_groups'] = DB::table('preferred_ages')->get();
        $data['categories'] = DB::table('category')->get();
        return view('partner.booked-activities', $data);
    }

    public function getBookedActivityAPI( Request $request )
    {
        $request_json = $request->get("query");
            $query = "CALL GET_KWD_DEALER_EVENTS('". $request_json ."')";
            //echo $query;die;
            $data['events'] = DB::select($query);
            //dd($data['events']);
        return view('partner.api.activity-booked', $data);
    }

    private function getDealerIdFromUserId($user_id){
        $dealer_id = DB::table('dealers')
                        ->where('user_id', '=', $user_id)
                        ->pluck('id')
                        ->first();
        return $dealer_id;
    }
}
