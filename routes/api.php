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

# Attachment routes
// Editor Image Upload
Route::post('active-center/images/upload', 'AttachmentController@postImageUpload');
// Upload attachments
Route::post('/attachments/store', 'AttachmentController@storeAttachments');
// Get attachments
Route::get('asset/attachments/{ids}', 'AttachmentController@pullAttachments');
// Delete attachments
Route::delete('/attachments/', 'AttachmentController@deleteAttachment');

# 1.1 active-center routes
// List active-center
Route::get('active-centers', 'ActiveCenterController@index');
// List single active-center
Route::get('active-center/{id}', 'ActiveCenterController@show');
// Create new active-center
Route::post('active-center', 'ActiveCenterController@store');
// Update active-center
Route::put('active-center', 'ActiveCenterController@store');
// Delete active-center
Route::delete('active-center/{id}', 'ActiveCenterController@destroy');
// List single active-center
Route::post('active-centers', 'ActiveCenterController@getActiveCenterData');

# 1.2 Notice routes
// List notice
Route::get('notices', 'NoticeController@index');


# 1.2.1 Event routes
// List event
Route::get('events', 'EventController@index');
// List single event
Route::get('event/{id}', 'EventController@show');
// Create new event
Route::post('event', 'EventController@store');
// Update event
Route::put('event', 'EventController@store');
// Delete event
Route::delete('event/{id}', 'EventController@destroy');
// List with parameters
Route::post('events', 'EventController@getEventData');


# 1.2.2 Volunteer routes
// List volunteer
Route::get('volunteers', 'VolunteerController@index');
// List single volunteer
Route::get('volunteer/{id}', 'VolunteerController@show');
// Create new volunteer
Route::post('volunteer', 'VolunteerController@store');
// Update volunteer
Route::put('volunteer', 'VolunteerController@store');
// Delete volunteer
Route::delete('volunteer/{id}', 'VolunteerController@destroy');
// List volunteer with parameters
Route::post('volunteers', 'volunteerController@getEventData');

# 1.2.3 Membership routes
// List Membership
Route::get('memberships', 'MembershipController@index');
// List single membership
Route::get('membership/{id}', 'MembershipController@show');
// Create new membership
Route::post('membership', 'MembershipController@store');
// Update membership
Route::put('membership', 'MembershipController@store');
// Delete membership
Route::delete('membership/{id}', 'MembershipController@destroy');
// List membership with parameters
Route::post('memberships', 'MembershipController@getEventData');

# 1.3 Subsidy routes
// List Subsidy
Route::get('subsidies', 'SubsidyController@index');
// List single Subsidy
Route::get('subsidy/{id}', 'SubsidyController@show');
// Create new Subsidy
Route::post('subsidy', 'SubsidyController@store');
// Update Subsidy
Route::put('subsidy', 'SubsidyController@store');
// Delete Subsidy
Route::delete('subsidy/{id}', 'SubsidyController@destroy');
// List single active-center
Route::post('subsidies', 'SubsidyController@getSubsidyData');

# 1.4 Disaster routes
// List Disaster
Route::post('disasters', 'DisasterController@index');
// List single Disaster
Route::get('disaster/{id}', 'DisasterController@show');
// Create new Disaster
Route::post('disaster', 'DisasterController@store');
// Update Disaster
Route::put('disaster', 'DisasterController@store');
// Delete Disaster
Route::delete('disaster/{id}', 'DisasterController@destroy');






