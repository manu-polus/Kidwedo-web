<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\dealer;
use App\UserRoles;
use App\Category;
use App\PreferredAges;
use App\Message;
use App\Event;
use App\EventDates;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;


class DealerController extends Controller
{
    public function loadActivityPage()
    {
        $data['categories'] = Category::get();
        $data['ages'] = PreferredAges::get();
        return view('partner.activity',$data);
    }
    public function postActivity(Request $request)
    {
        $this->validate($request,[
            'event_name' => 'required|min:4',
            'caregiver' => 'required',
            'event_pic' => 'required|image|file',
            'age' => 'required',
            'description' => 'required',
            'category' => 'required',
            'credits' => 'required',
            'arrive_before' => 'required',
            'cancel_policy' => 'required',
            'place' => 'required'
        ]);
        $credit_euro = DB::table('credit_euro_exchange_rate')
                        ->select('credit_point', 'credit_euro')
                        ->first();
        $credit_base_1 = (int)$credit_euro->credit_point/(int)$credit_euro->credit_euro;
        //$path = "";
        $path = $request->file('event_pic')->store('public/images/activity');
        
        $dealer = dealer::where('user_id','=',Auth::user()->id)->first();
        $dates = $request->input('date_list_input');
        $time_slots = array_filter(json_decode( $request->input('time_list_input') ));
        $dates_array = explode(",", $dates);
        $credit_euro = $request->input('credits');
        $credit_point = ceil((int)$credit_euro*$credit_base_1);
        $event = new Event();
        $event_dates = new EventDates();

        $event->pic_filename = $path;
        $event->event_name = $request->input('event_name');
        $event->is_caregiver_needed = $request->input('caregiver');
        $event->dealer_id = $dealer->id;
        $event->preferred_age_id = $request->input('age');
        $event->description = $request->input('description');
        $event->additional_description = $request->input('additional_description');
        $event->category_id = $request->input('category');
        $event->credit = $credit_point;
        $event->event_duration = "1:00 hr"; //This field should be calculated from time difference between from time and to time
        $event->arrive_before = $request->input('arrive_before');
        $event->cancellation_policy = $request->input('cancel_policy');
        $event->location_longitude = "12345"; //Longitude should be from map
        $event->location_latitude = "78901"; //Latitude should be from map
        $event->cancellation_policy;
        $event->city = $request->input('place');
        $event->event_status = "Pending";
        $event->credits_in_euro = $credit_euro;
        //$url = Storage::url($path);
        //echo "<img src = ".$url.">";
        //return redirect()->route('partneractivity');
        
        if($event->save())
        {
            $event_id = $event->id;
            $date_array = array();
            foreach($time_slots as $time_slot){
                foreach($dates_array as $date){
                    $from = str_replace(' ', '',  $time_slot->from).":00";
                    $to = str_replace(' ', '',  $time_slot->to).":00";
                    $date_array[] = ['event_id' => $event_id, 'date' => $date, 'from_time'=>$from, 'to_time'=>$to, 'total_seats'=>'100', 'seat_remaining'=>'100'];
                }
            }
            DB::table('event_dates')->insert(
                $date_array
            );
            return redirect()->route('partnerhome');
        }
    }

    public function updateActivity(Request $request, $id)
    {
        $this->validate($request,[
            'event_name' => 'required|min:4',
            'caregiver' => 'required',
            'age' => 'required',
            'description' => 'required',
            'category' => 'required',
            'credits' => 'required',
            'arrive_before' => 'required',
            'cancel_policy' => 'required',
            'place' => 'required'
        ]);
        $event = Event::where('id','=',$id)->first();
        $credit_euro = DB::table('credit_euro_exchange_rate')
                        ->select('credit_point', 'credit_euro')
                        ->first();
        $credit_base_1 = (int)$credit_euro->credit_point/(int)$credit_euro->credit_euro;

        if($request->file('event_pic')){
            $path = $request->file('event_pic')->store('public/images/activity');
            $event->pic_filename = $path;
        }
            
        $dealer = dealer::where('user_id','=',Auth::user()->id)->first();

        $dates = $request->input('date_list_input');
        $time_slots = array_filter(json_decode( $request->input('time_list_input') ));
        $dates_array = explode(",", $dates);
        $credit_euro = $request->input('credits');
        $credit_point = ceil((int)$credit_euro*$credit_base_1);

        $event->event_name = $request->input('event_name');
        $event->is_caregiver_needed = $request->input('caregiver');
        $event->dealer_id = $dealer->id;
        $event->preferred_age_id = $request->input('age');
        $event->description = $request->input('description');
        $event->additional_description = $request->input('additional_description');
        $event->category_id = $request->input('category');
        $event->credit = $credit_point;
        $event->event_duration = "1:00 hr"; //This field should be calculated from time difference between from time and to time
        $event->arrive_before = $request->input('arrive_before');
        $event->cancellation_policy = $request->input('cancel_policy');
        $event->location_longitude = "12345"; //Longitude should be from map
        $event->location_latitude = "78901"; //Latitude should be from map
        $event->cancellation_policy;
        $event->city = $request->input('place');
        $event->event_status = "Pending";
        $event->credits_in_euro = $credit_euro;
        //$url = Storage::url($path);
        //echo "<img src = ".$url.">";
        //return redirect()->route('partneractivity');
        if($event->update())
        {
            $event_id = $id;
            $date_array = array();
            foreach($time_slots as $time_slot){
                $from = str_replace(' ', '',  $time_slot->from).":00";
                $to = str_replace(' ', '',  $time_slot->to).":00";
                foreach($dates_array as $date){
                    
                    $date_array[] = ['event_id' => $event_id, 'date' => $date, 'from_time'=>$from, 'to_time'=>$to, 'total_seats'=>'100', 'seat_remaining'=>'100'];
                }
            }
            //dd($dates_array);
            foreach($dates_array as $date){
               $dlt = DB::table('event_dates')
                        ->where('event_id', '=', $event_id)
                        ->delete();
            }
            //dd($date_array);
            DB::table('event_dates')->insert(
                $date_array
            );
                return redirect()->route('partnerhome');
        }
    }

    public function editActivity($id)
    {
        $valid_dealer = $this->checkDealerAuthentication($id);

        if($valid_dealer)
        {
            $data['activity'] = Event::where('id','=', $id)->first();
            //$times = EventDates::where('event_id','=',$id)->get();
            $dates = DB::table('event_dates')
                        ->select('date')
                        ->where('event_id', '=', $id)
                        ->distinct('date')
                        ->get();
            $times = DB::table('event_dates')
                        ->select('from_time', 'to_time')
                        ->where('event_id', '=', $id)
                        ->distinct('from_time', 'to_time')
                        ->get();
            $date_comma = "";
            foreach($times as $time){
                $time->from_time = preg_replace("/:00$/", '', $time->from_time );
                $time->to_time = preg_replace("/:00$/", '', $time->to_time );
            }
            foreach($dates as $date){
                $date_comma .= $date->date.",";
            }
            $data['activity_image'] = Storage::url($data['activity']->pic_filename);
            $data['times'] = $times;
            $data['dates'] = $dates;
            $data['date_comma'] = rtrim($date_comma, ",");
            $data['categories'] = Category::get();
            $data['ages'] = PreferredAges::get();
            return view('partner.edit_activity',$data);
        }
        else
        {
            return redirect()->route('partnerhome');
        }
    }

    public function deleteActivity($id)
    {
        DB::table('event_dates')
            ->where('event_id', '=', $id)
            ->delete();
        DB::table('events')
            ->where('id', '=', $id)
            ->delete();
        return redirect()->route('partnerhome');
    }
    public function checkDealerAuthentication($id)
    {
        $record = DB::table('events AS e')
                    ->join('dealers AS d','e.dealer_id','=','d.id')
                    ->join('users AS u','u.id','=','d.user_id')
                    ->where('u.id','=',Auth::user()->id)
                    ->where('e.id','=',$id)
                    ->first();
        if($record != null)
        {
            return true;
        }
        else
        {
            return false;
        }
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
        where m.IsProviderDeleted = "N" and (m.from_user_id = '.Auth::user()->id.' or m.to_user_id = '.Auth::user()->id.') order by created_at desc');
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
        //dd($message_array);
        $data['messages'] = $message_array;
        return view('partner.messages',$data);
    }

    public function deleteMessage($id)
    {
        $message = Message::where('id','=',$id)->first();
        $message->IsProviderDeleted = 'Y';

        if($message->update())
        {
            return redirect()->route('partner_messages.view');
        }
    }

    public function postMessage(Request $request)
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
            return redirect()->route('partner_messages.view');
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
    
    public function partnerCredits()
    {
        $dealer_id = dealer::where('user_id','=',Auth::user()->id)->pluck('id')->first();
        $query = "CALL GET_KWD_DEALER_CREDITS(".$dealer_id.")";
        $data['credits'] = DB::select($query);
        //dd($data['credits']);
        $data['total'] = array_sum(array_column($data['credits'], 'credits_in_euro'));
        //dd($data['credits']);
        return view('partner.credits',$data);
    }

    public function str_lreplace($search, $replace, $subject)
    {
        $pos = strrpos($subject, $search);
    
        if($pos !== false)
        {
            $subject = substr_replace($subject, $replace, $pos, strlen($search));
        }
    
        return $subject;
    }
}
