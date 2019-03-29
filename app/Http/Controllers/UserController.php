<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ActivityController;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\dealer;
use App\Message;
use App\ProviderReview;
use App\EventReview;
use DateTime;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    public function passwordReset(Request $request)
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
            \Session::put('error', 'Incorrect Password');
            return redirect()->route('account_settings');
        }
    }
    public function postProfile(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|min:3',
            'address' => 'max:191',
            'phone' => 'required|min:3'
        ]);

        $user = User::where('id',Auth::user()->id)->first();
        $user->name = $request->input('name');
        $user->last_name = $request->input('surname');
        $user->mobile_number = $request->input('phone');
        $user->address = $request->input('address');

        if($user->update())
        {
            \Session::put('success', 'Profile updated!');
            return redirect()->route('profile');
        }
    }

    public function passwordResetPartner(Request $request)
    { 
        $this->validate($request,[
            'new_password' => 'confirmed',
        ]);
        if(Hash::check($request->input('password'), Auth::user()->password))
        {
            $user = User::where('id',Auth::user()->id)->first();
            $user->password = Hash::make($request->input('new_password'));
            if($user->update())
            {
                \Session::put('success', 'Neues Passwort registriert. Bitte melde dich mit deinem neuen Passwort an');
                Auth::logout();
                return redirect()->route('partnerlogin');
            }
        }
        else
        {
            \Session::put('error', 'Falsches Passwort');
            return redirect()->route('partner_account_settings');
        }
    }
    public function postProfilePartner(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|min:3',
            'address' => 'max:191',
            'phone' => 'required|min:3',
            'picture' => 'image',
            'logo' => 'image'
        ]);
        
        $user = User::where('id',Auth::user()->id)->first();
        $user->name = $request->input('name');
        $user->mobile_number = $request->input('phone');
        $user->address = $request->input('address');

        if($user->update())
        {
            $dealer = dealer::where('user_id',Auth::user()->id)->first();
            $logo_path = $request->file('logo')->store('public/images/provider');
            $picture_path = $request->file('picture')->store('public/images/provider');
            $dealer->business_name = $request->input('business_name');
            $dealer->main_pic_filename = $picture_path;
            $dealer->logo_pic_filename = $logo_path;
            $dealer->description = $request->input('about');
            $dealer->website = $request->input('website');
            $dealer->zipcode = $request->input('zipcode');
            
            if($dealer->update())
            {
                \Session::put('success', 'Profile updated!');
                return redirect()->route('partner_profile');
            }
        }
    }
    public function viewActivity($id)
    {
        $activity = new ActivityController();
        $event_schedule = DB::table('event_dates')
                            ->where('id', '=', $id)
                            ->first();
        $data['activity'] = DB::table('events AS e')
                    ->join('dealers AS d','e.dealer_id','=','d.id')
                    ->join('event_dates AS ed','e.id','=','ed.event_id')
                    ->join('users AS u','d.user_id','=','u.id')
                    ->join('preferred_ages AS p','e.preferred_age_id','=','p.id')
                    ->select('u.id AS user_id','d.id AS deader_id','ed.id AS event_id','e.id AS event','event_name','e.pic_filename', 'p.description AS age','category_id','d.description AS dealer_description','e.description AS event_description','additional_description','city','credit','event_status','cancellation_policy','is_caregiver_needed','event_duration','e.location_longitude AS event_longitude','e.location_latitude AS event_latitude','d.location_longitude AS dealer_longitude','d.location_latitude AS dealer_latitude','pic_filename AS activity_pic','logo_pic_filename AS dealer_logo','main_pic_filename AS dealer_pic','d.user_id AS user_id','business_name','arrive_before','zipcode','website','editors_tip','date','from_time','to_time','total_seats','seat_remaining','address')
                    ->where('e.id','=',$event_schedule->event_id)
                    ->first();
        $booking = DB::table('user_purchase')
                    ->where('user_id', '=', Auth::user()->id)
                    ->where('eventdate_plan_id', '=', $id)
                    ->orderBy('id', 'desc')
                    ->first();
        $data['user_booked'] = false;
        $data['book_url'] = route('activity.booking',['id' => $event_schedule->id ]);
        if ($booking != null) {
            if($booking->purchase_status == 'Active'){
                $data['user_booked'] = true;
                $data['ticket_url'] = route('activity.print-ticket',['id' => Crypt::encrypt($booking->id)]);
            }
            else{

            }

        }
        else{
            $data['user_booked'] = false;
            $data['book_url'] = route('activity.booking',['id' => $event_schedule->id ]);
        }
        $data['activity_image'] = Storage::url($data['activity']->pic_filename);
        $data['schedule'] = $event_schedule;
        $newDate = DateTime::createFromFormat('Y-m-d', $event_schedule->date);
        $data['schedule']->date_name = $newDate->format('l'); 

        //dd($data);
        if($data['activity']->dealer_pic != null)
        {
            $data['dealer_picture'] = Storage::url($data['activity']->dealer_pic);
        }
        if($data['activity']->dealer_logo != null)
        {
            $data['dealer_logo'] = Storage::url($data['activity']->dealer_logo);
        }
        if($data['activity']->activity_pic != null)
        {
            $data['activity_picture'] = Storage::url($data['activity']->activity_pic);
        }

        //echo $data['dealer_logo'];
        //dd($data);

        $rating = EventReview::where('user_id','=',Auth::user()->id)
                                ->where('event_id','=',$data['activity']->event)
                                ->get();
        if(count($rating) == 0)
        {
            $data['is_rated'] = false;
        }
        else
        {
            $data['is_rated'] = true;
        }

        $ratings = DB::table('event_ratings AS er')->join('users AS u','er.user_id','=','u.id')
                    ->select('u.id AS user_id','u.name AS name','er.rating AS rating','er.comment AS comment','er.created_at AS created_at')
                    ->where('er.event_id','=',$data['activity']->event)
                    ->get();
        $data['rating_count'] = count($ratings);
        $data['reviews'] = $ratings;
        $data['rate_avg'] = DB::table('event_ratings')->where('event_id','=',$data['activity']->event)->avg('rating');
        $data['rate_avg'] = round($data['rate_avg']);
        $data['next_five_activities'] = $activity->getNextFiveActivitiesBasedEvent($data['activity']->event);

        $my_rating = DB::table('event_ratings')->where('event_id','=',$data['activity']->event)->where('user_id','=',Auth::user()->id)->first();
        
        if($my_rating == null)
        {
            $data['my_rating'] = 0;
        }
        else
        {
            $data['my_rating'] = $my_rating->rating;
        }
        $rating_avg = DB::table('dealers AS d')
                    ->join('events AS e','d.id','=','e.dealer_id')
                    ->join('event_ratings AS er','e.id','=','er.event_id')
                    ->where('d.id','=',$data['activity']->deader_id)
                    ->get();
        
        if($rating_avg != null)
        {
            $data['number_of_events'] = count($rating_avg->unique('event_id'));
            $data['provider_rating'] = $rating_avg->avg('rating');
            $data['number_of_ratings'] = count($rating_avg);
            $data['provider_rating'] = round($data['provider_rating']);
        }
        else
        {
            $data['number_of_events'] = 0;
            $data['provider_rating'] = 0;
            $data['number_of_ratings'] = 0;
        }
        return view('user.activityview',$data);
    }
    
    public function loadLanding()
    {
        if((Auth::user() != null) && (Auth::user()->status_id == 1))
        {
            return view('landing');
        }
    }

    public function viewDealer($id)
    {
        $provider_and_activity = new ActivityController();
        $data['dealer'] = $provider_and_activity->getProviderDetails($id);
        $data['next_five_activities'] = $provider_and_activity->getNextFiveActivities($data['dealer']->dealer_id);
        //dd($data['next_five_activities']);
        if($data['dealer']->dealer_pic != null)
        {
            $data['dealer_picture'] = Storage::url($data['dealer']->dealer_pic);
        }
        if($data['dealer']->dealer_logo != null)
        {
            $data['dealer_logo'] = Storage::url($data['dealer']->dealer_logo);
        }
        
        //$data['activity_picture'] = Storage::url($data['activity']->activity_pic);
        //echo $data['dealer_logo'];
        //dd($data['dealer']);

        $check_rating = ProviderReview::where('user_id','=',Auth::user()->id)
                                ->where('dealer_id','=',$data['dealer']->dealer_id)
                                ->get();
        if(count($check_rating) == 0)
        {
            $data['is_rated'] = false;
        }
        else
        {
            $data['is_rated'] = true;
        }

        $rating = DB::table('dealers AS d')
                    ->join('events AS e','d.id','=','e.dealer_id')
                    ->join('event_ratings AS er','e.id','=','er.event_id')
                    ->select('d.*','e.*','er.*','er.created_at AS create_date')
                    ->where('d.id','=',$data['dealer']->dealer_id)
                    ->orderBy('er.id','desc')
                    ->get();

        $user_list = User::select('id','name')->get();

        $comment_details = [];
        $comments = [];
        foreach($rating as $rate)
        {
            foreach($user_list as $user)
            { 
                if($rate->user_id == $user->id)
                {
                    $date = date('d.m.Y', strtotime($rate->create_date));
                    $comment_details = [
                            'name' => $user->name,
                            'rating' => $rate->rating,
                            'comment' => $rate->comment,
                            'date' => $date
                    ];
                    array_push($comments, $comment_details);
                    break;
                }
            }
        }
        $data['reviews'] = $comments;
        if($rating != null)
        {
            //$data['number_of_events'] = count($rating->unique('event_id'));
            $data['provider_rating'] = $rating->avg('rating');
            $data['number_of_ratings'] = count($rating);
            $data['provider_rating'] = round($data['provider_rating']);
        }
        else
        {
            $data['number_of_events'] = 0;
            $data['provider_rating'] = 0;
            $data['number_of_ratings'] = 0;
        }
        
        return view('user.partnerview',$data);
    }

    public function viewMessages()
    {
        $unread_messages = DB::table('messages')
											->where('to_user_id','=',Auth::user()->id)
											->where('IsReadMessage','=','N')
                                            ->get();
        if(count($unread_messages) > 0)
        {
            DB::table('messages')
            ->where('to_user_id','=',Auth::user()->id)
            ->update(['IsReadMessage' => 'Y']);
        }
        $messages = DB::select('select m.*,u.name from messages m left join users u on m.from_user_id = u.id 
        where m.IsUserDeleted = "N" and (m.from_user_id = '.Auth::user()->id.' or m.to_user_id = '.Auth::user()->id.') order by created_at desc');
        $message_array = array();
        $time = null;
        $id=0;
        foreach($messages as $message){
            if($message->parent_id == 0){
                $time = $this->processTime($message);
                $message_array[$message->id] = array();
                $message_array[$message->id]['id'] = $message->id;
                $message_array[$message->id]['subject'] = $message->subject;
                $message_array[$message->id]['from_user_id'] = $message->from_user_id;
                $message_array[$message->id]['to_user_id'] = $message->to_user_id;
                $message_array[$message->id]['parent_id'] = $message->parent_id;
                $message_array[$message->id]['message'] = $message->message;
                $message_array[$message->id]['name'] = $message->name;
                $message_array[$message->id]['created_at'] = $message->created_at;
                $message_array[$message->id]['time'] = $time;
            }
        }
        foreach($messages as $message){
            $parent = $message->id;
             if( $message->parent_id != 0 ){
                foreach($message_array as $key=>$message_parent){
                    if( $message->parent_id == $key ){
                        $time = $this->processTime($message);
                        $msg['id'] = $message->id;
                        $msg['name'] = $message->name;
                        $msg['subject'] = $message->subject;
                        $msg['message'] = $message->message;
                        $msg['parent_id'] = $message->parent_id;
                        $msg['created_at'] = $message->created_at;
                        $msg['from_user_id'] = $message->from_user_id;
                        $msg['to_user_id'] = $message->to_user_id;
                        $msg['time'] = $time;
                        $message_array[$key]['child'][$message->id] = $msg;
                    }
                }   
            }
        }
        $data['messages'] = $message_array;
        return view('user.messages',$data);
    }

    public function deleteMessage($id)
    {
        $message = Message::where('id','=',$id)->first();
        $message->IsUserDeleted = 'Y';

        if($message->update())
        {
            return redirect()->route('messages.view');
        }
    }

    public function postMessage(Request $request)
    {
        $this->validate($request,[
            'subject' => 'required|min:4',
            'message' => 'required|min:5'
        ]);

        $message = new Message();
        $message->from_user_id = Auth::user()->id;
        $message->to_user_id = $request->input('to_user_id');
        $message->subject = $request->input('subject');
        $message->message = $request->input('message');
        $message->parent_id = 0;
        $message->IsReadMessage = 'N';
        $message->IsUserDeleted = 'N';
        $message->IsProviderDeleted = 'N';
        if($message->save())
        {
            return redirect()->route('partner.view',['id' => $request->input('to_user_id')]);
        }
    }
    public function postMessageReply(Request $request)
    {
        $this->validate($request,[
                'message' => 'required|min:5'
            ]);
    
            $message = new Message();
            $message->from_user_id = Auth::user()->id;
            $message->to_user_id = $request->input('to_user_id');
            $message->subject = $request->input('subject');
            $message->message = $request->input('message');
            $message->parent_id = $request->input('parent_id');
            $message->IsReadMessage = 'N';
            $message->IsUserDeleted = 'N';
            $message->IsProviderDeleted = 'N';
            if($message->save())
            {
                return redirect()->route('messages.view');
            }
    }
    public function postDealerRating(Request $request)
    {
        $this->validate($request,[
            'rating' => 'required',
            'comment' => 'required'
        ]);

        $provider_review = new ProviderReview();
        $provider_review->user_id = $request->input('user_id');
        $provider_review->dealer_id = $request->input('dealer_id');
        $provider_review->rating = $request->input('rating');
        $provider_review->comment = $request->input('comment');
        
        if($provider_review->save())
        {
            return redirect()->route('partner.view',['id' => $request->input('user_id_dealer')]);
        }
    }
    
    public function postActivityRating(Request $request)
    {
        $this->validate($request,[
            'rating' => 'required',
            'comment' => 'required'
        ]);
        $event_review = new EventReview();
        $event_review->user_id = $request->input('user_id');
        $event_review->event_id = $request->input('event_id');
        $event_review->rating = $request->input('rating');
        $event_review->comment = $request->input('comment');
        
        if($event_review->save())
        {
            return redirect()->route('activity.view',['id' => $request->input('event_redirect')]);
        }
    }

    public function processTime($message)
    {
        $current_date = date('Y-m-d H:i:s');
        $current_date = new \DateTime($current_date);
        $post_date = new \DateTime($message->created_at);
        $interval = $post_date->diff($current_date);
		if($interval->y > 0)
		{
			$time = $interval->y." Year(s) ago by";
		}
		elseif($interval->m > 0)
		{
			$time = $interval->m." Month(s) ago by";
		}
		elseif($interval->d > 0)
		{
			$time = $interval->d." Day(s) ago by";
		}
		elseif($interval->h > 0)
		{
			$time = $interval->h." Hour(s) ago by";
		}
		else
		{
			$time = $interval->i." Minute(s) ago by";
        }
        return $time;
    }

    public function viewCredits()
    {
        $query = "CALL GET_KWD_USER_CREDITS(".Auth::user()->id.")";
        //$query = "CALL GET_KWD_USER_CREDITS(3)";
        $data['credits'] = DB::select($query);
        //dd($data['credits']);
        return view('user.credits',$data);
    }

    public function viewPaymentInfo($id)
    {

        return view('payment',$data);
    }
}
