<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/v1/get-activity', 'ActivityController@getActivity')->name("activity_url");

Route::post('/v1/get-provideractivity', 'ActivityController@getProviderCalendarActivity')->name("activity_provider_url");
// Get activity for parent user
Route::post('/v1/get-activity', 'ActivityController@getActivity')->name("activity_url");

Route::post('/v1/get-booked-activity', 'ActivityController@getBookedActivityAPI')->name("partner_booked_activity_url");


Route::middleware('auth')->group(function()
{
    Route::middleware('provider')->group(function()
    {
        
    });
});
// Get activity for partner
Route::post('/v1/get-partner-activity', 'ActivityController@getPartnerActivitiesAPI')->name("partner_activity_url");