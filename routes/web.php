<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Route::get('test', 'PaymentController@readResponse');

Route::get('/', 'HomeController@loginCheck')->name('plans');


Route::get('private-provider', 'GuestController@loadPrivateProvider')->name('private_provider');

Route::get('commercial-provider', 'GuestController@loadCommercialProvider')->name('commercial_provider');

Route::get('our-team', 'GuestController@loadOurTeam')->name('our_team');

Route::get('privacy-policy', 'GuestController@loadPrivacyPolicy')->name('privacy_policy');

Route::get('career', 'GuestController@loadCareer')->name('career');

Route::get('career/lists', 'GuestController@loadCareerLists')->name('career_lists');

Route::get('career/job', 'GuestController@loadJob')->name('career_job');

Route::get('contact-us', 'GuestController@loadContactUs')->name('contact_us');

Route::get('contact-us/post', 'GuestController@postContactUs')->name('contact_us.post');

Route::get('imprint', 'GuestController@loadImprint')->name('imprint');

Route::get('about', 'GuestController@loadAboutUs')->name('about');

Route::get('/redirect', 'SocialAuthFacebookController@redirect');

Route::get('/callback', 'SocialAuthFacebookController@callback');

Route::get('/trial',  function()
{
    return view('plans');
})->name('trialplan');

Route::get('partner/registration', function(){
    return view('partner.register');
})->name('partnerregistration');

Route::post('partner/registration', 'GuestController@insertDealer')->name('partnerregistration');

Route::get('partner/login', function(){
    return view('partner.login');
})->name('partnerlogin');

Route::get('payment', function()
    {
        return view('paypal.paypal');
    })->name('payment');

// route for processing paypal payment
Route::post('paypal', 'PaymentController@payWithpaypal')->name('pay');

// route for check status of the paypal payment
Route::get('status', 'PaymentController@getPaymentStatus');

Auth::routes();

Route::middleware('auth')->group(function()
{
    Route::middleware('user')->group(function()
    {
        Route::get('dealer/{id}','UserController@viewDealer')->name('partner.view');

        Route::post('dealer/postrate','UserController@postDealerRating')->name('provider_rating.post');

        Route::get('activity/{id}','UserController@viewActivity')->name('activity.view');

        Route::post('activity/postrate','UserController@postActivityRating')->name('activity_rating.post');

        Route::get('book/{id}','ActivityController@bookActivity')->name('activity.booking');

        Route::post('book','ActivityController@bookActivityInsert')->name('activity.booking.post');

        Route::get('booking-success/{id}','ActivityController@bookingSuccess')->name('activity.booking.success');
        
        Route::get('print-ticket/{id}','ActivityController@printTicket')->name('activity.print-ticket');

        Route::get('messages','UserController@viewMessages')->name('messages.view');

        Route::get('credits','UserController@viewCredits')->name('credits.view');

        Route::post('messages/post','UserController@postMessage')->name('message.post');

        Route::get('messages/delete/{id}','UserController@deleteMessage')->name('message.delete');

        Route::get('activities', 'ActivityController@activity')->name('activity');

        Route::post('messages/reply/post','UserController@postMessageReply')->name('user_message.post');

        Route::get('account-settings', function(){
            return view('user.accountsettings');
         })->name('account_settings');
    
        Route::post('account-settings','UserController@passwordReset')->name('passwordreset');

        Route::get('profile', function(){
            return view('user.profile');
         })->name('profile');
    
        Route::get('/welcome','UserController@loadLanding')->name('landing');
    
        Route::post('profile','UserController@postProfile')->name('profile');

        //Route::get('subscribe/payment/{$id}', 'UserController@viewPaymentInfo')->name('paymentinfo');
    
        Route::get('subscribe', function(){
            return view('user.subscribe');
         })->name('subscribe');
         
    });

    Route::middleware('admin')->group(function()
    {
        Route::get('/admin/dealer/home','AdminController@loadActiveDealers')->name('adminhome');
    
        Route::get('admin/dealer/waiting', 'AdminController@loadWaitingDealers')->name('awaitingdealers');
    
        Route::get('admin/dealer/blocked','AdminController@loadBlockedDealers')->name('blockeddealers');

        Route::post('/admin/dealer/edit','AdminController@editDealer')->name('editdealer');

        Route::get('/admin/dealer/accept/{id}','AdminController@acceptDealer')->name('acceptdealer');

        Route::get('/admin/dealer/block/{id}','AdminController@blockDealer')->name('blockdealer');

        Route::get('/admin/dealer/delete/{id}','AdminController@deleteDealer')->name('deletedealer');

        Route::get('/admin/users/list', 'AdminController@usersLoad')->name('users_list');

        Route::post('/admin/users/edit/','AdminController@editUser')->name('edit_user');

        Route::get('/admin/users/delete/{id}','AdminController@deleteUser')->name('delete_user');

        Route::get('admin/events/pending', 'AdminController@loadPendingEvents')->name('pending_events_list');

        Route::get('admin/events/pending/{id}', 'AdminController@approvePendingEvent')->name('approve_event');

        Route::get('admin/events/active', 'AdminController@loadActiveEvents')->name('active_events_list');

        Route::get('admin/setting', 'AdminController@changePassword')->name('change_password');

        Route::post('admin/setting', 'AdminController@confirmChangePassword')->name('change_password');

        Route::get('admin/site-settings', 'AdminController@loadCreditRatePage')->name('admin_credit');

        Route::post('admin/site-settings', 'AdminController@updateCreditRate')->name('change_rate');
    });

    Route::middleware('provider')->group(function()
    {
        Route::get('/partner/account-settings', function(){
            return view('partner.accountsettings');
         })->name('partner_account_settings');
    
        Route::post('/partner/account-settings','UserController@passwordResetPartner')->name('partner_passwordreset');
    
        Route::get('/partner/profile', function(){
            $data['partner'] = DB::table('dealers')->where('user_id',Auth::user()->id)->first();
            return view('partner.profile',$data);
         })->name('partner_profile');

        Route::get('partner/activity/{id}','DealerController@viewActivity')->name('partner_activity.view');
    
        Route::post('/partner/profile','UserController@postProfilePartner')->name('partner_profile');

        Route::get('/partner/myactivities','ActivityController@providerActivity')->name('partnerhome');

        Route::get('/partner/booked-activities','ActivityController@bookedActivity')->name('partner.booked');

        Route::get('/partner/myactivity/edit/{id}','DealerController@editActivity')->name('activity.edit');

        Route::post('/partner/myactivity/edit/{id}','DealerController@updateActivity')->name('activity.update');

        Route::get('/partner/myactivity/delete/{id}','DealerController@deleteActivity')->name('activity.delete');

        Route::get('/partner/myactivity/cancel/{id}','DealerController@cancelActivity')->name('activity.cancel');

        Route::get('/partner/activity','DealerController@loadActivityPage')->name('partneractivity');
    
        Route::post('/partner/activity','DealerController@postActivity')->name('partneractivity');

        Route::get('partner/messages','DealerController@viewMessages')->name('partner_messages.view');

        Route::post('partner/messages/post','DealerController@postMessage')->name('partner_message.post');

        Route::get('partner/messages/delete/{id}','DealerController@deleteMessage')->name('partner_message.delete');
        
        Route::get('partner/credits','DealerController@partnerCredits')->name('partner_credits');

        Route::get('partner/bookings','DealerController@partnerBookings')->name('partner.bookings');

        

    
    });
    
    Route::get('home', 'HomeController@index')->name('home');
});