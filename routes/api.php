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

Route::group(['middleware' => 'api','prefix' => 'auth'], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

    
});

Route::group(['middleware' => 'jwt.auth'], function ($router) {

    # 1.1 active-center routes
    // List active-center
    //Route::get('active-centers', 'ActiveCenterController@index');
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
    // List single active-center
    Route::post('active-center-featured', 'ActiveCenterController@updateFeatured');
    // List single active-center
    Route::get('active-center-featured', 'ActiveCenterController@getFeatured');

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
    // List active-center
    Route::get('disasters', 'DisasterController@index');
    // List Disaster
    Route::post('getDisasterData', 'DisasterController@index');
    // List single Disaster
    Route::get('disaster/{id}', 'DisasterController@show');
    // Create new Disaster
    Route::post('disaster', 'DisasterController@store');
    // Update Disaster
    Route::put('disaster', 'DisasterController@store');
    // Delete Disaster
    Route::delete('disaster/{id}', 'DisasterController@destroy');
    // List single active-center
    Route::post('disasters', 'DisasterController@getDisasterData');

    # 3 Group-information routes
    // List group-information
    Route::get('group-informations', 'GroupInformationController@index');
    // List single group-information
    Route::get('group-information/{id}', 'GroupInformationController@show');
    // Create new group-information
    Route::post('group-information', 'GroupInformationController@store');
    // Update group-information
    Route::put('group-information', 'GroupInformationController@store');
    // Delete group-information
    Route::delete('group-information/{id}', 'GroupInformationController@destroy');
    // List group-information with parameters
    Route::post('group-informations', 'GroupInformationController@getGroupInformationData');
    // List group-information with parameters
    Route::post('upload-file', 'GroupInformationController@storeUploadData');
    // Download group-information as CSV
    Route::get('download-file', 'GroupInformationController@getDownlaodData');
    
});

// 

# 1.1 active-center routes
// List active-center
Route::get('active-centers-frontend', 'ActiveCenterController@index');
// List single active-center
Route::get('active-center-frontend/{id}', 'ActiveCenterController@show');


# Attachment routes
// Editor Image Upload
Route::post('active-center/images/upload', 'AttachmentController@postImageUpload');
// Upload attachments
Route::post('/attachments/store', 'AttachmentController@storeAttachments');
// Get attachments
Route::get('asset/attachments/{ids}', 'AttachmentController@pullAttachments');
// Delete attachments
Route::delete('/attachments/', 'AttachmentController@deleteAttachment');
// Download attachments
Route::get('/download/{file}', function ($file='') {
    return response()->download(public_path('public/attachments/'.$file)); 
});



# 1.2 Notice routes
// List notice
Route::get('notices', 'NoticeController@index');
// List with parameters
Route::post('notices', 'NoticeController@getNoticeData');
// List with parameters
Route::post('notices-frontend', 'NoticeController@getNoticeFrontData');
// List notice
Route::get('notices-homepage', 'NoticeController@getNoticeHomePageData');


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
Route::get('subsidies-frontend', 'SubsidyController@index');
// List single Subsidy
Route::get('subsidy-frontend/{id}', 'SubsidyController@show');

# 1.4 Disaster routes
// List active-center
Route::get('disasters-frontend', 'DisasterController@index');
// List single Disaster
Route::get('disaster-frontend/{id}', 'DisasterController@show');

# 2.1 Various routes
// List various
Route::get('variouses', 'VariousController@index');
// List single various
Route::get('various/{id}', 'VariousController@show');
// Create new various
Route::post('various', 'VariousController@store');
// Update various
Route::put('various', 'VariousController@store');
// Delete various
Route::delete('various/{id}', 'VariousController@destroy');
// List membership with parameters
Route::post('variouses', 'VariousController@getVariousData');
// List membership with parameters
Route::get('variouses-frontend', 'VariousController@getVariousFrontData');


# 2.2 Business-report routes
// List business-report
Route::get('business-reports', 'BusinessReportController@index');
// List single business-report
Route::get('business-report/{id}', 'BusinessReportController@show');
// Create new business-report
Route::post('business-report', 'BusinessReportController@store');
// Update business-report
Route::put('business-report', 'BusinessReportController@store');
// Delete business-report
Route::delete('business-report/{id}', 'BusinessReportController@destroy');
//  List business-report
Route::post('business-reports', 'BusinessReportController@getBusinessReportData');
// List single business
Route::get('frontpage-business-reports', 'BusinessReportController@getFrontPageData');

# 2.3 Dream routes
// List dream
Route::get('dreams', 'DreamController@index');
// List single dream
Route::get('dream/{id}', 'DreamController@show');
// Create new dream
Route::post('dream', 'DreamController@store');
// Update dream
Route::put('dream', 'DreamController@store');
// Delete dream
Route::delete('dream/{id}', 'DreamController@destroy');
//  List dream
Route::post('dreams', 'DreamController@getDreamData');
// List dream
Route::get('dreams-frontend', 'DreamController@getDreamDataFront');

# 2.4 Kawarabi routes
// List kawarabi
Route::get('kawarabis', 'KawarabiController@index');
// List single kawarabi
Route::get('kawarabi/{id}', 'KawarabiController@show');
// Create new kawarabi
Route::post('kawarabi', 'KawarabiController@store');
// Update kawarabi
Route::put('kawarabi', 'KawarabiController@store');
// Delete kawarabi
Route::delete('kawarabi/{id}', 'KawarabiController@destroy');
// List membership with parameters
Route::post('kawarabis', 'KawarabiController@getKawarabiData');
// List kawarabi
Route::get('kawarabis-frontend', 'KawarabiController@getKawarabiDataFront');


# 2.4 Year routes
// List year
Route::get('years', 'YearController@index');
// List single year
Route::get('year/{id}', 'YearController@show');
// Create new year
Route::post('year', 'YearController@store');
// Update year
Route::put('year', 'YearController@store');
// Delete year
Route::delete('year/{id}', 'YearController@destroy');
// List membership with parameters
Route::post('years', 'YearController@getYearData');


# 2.4 Business routes
// List business
Route::get('businesses', 'BusinessController@index');
// List single business
Route::get('business/{id}', 'BusinessController@show');
// Create new business
Route::post('business', 'BusinessController@store');
// Update business
Route::put('business', 'BusinessController@store');
// Delete business
Route::delete('business/{id}', 'BusinessController@destroy');
// List membership with parameters
Route::post('businesses', 'BusinessController@getBusinessData');
// List single business
Route::get('business/year/{id}', 'BusinessController@yearWiseBusiness');


# 3 Group-information routes
// List membership with parameters
Route::post('group-informations-frontend', 'GroupInformationController@getGroupInformationFrontData');
// List single group-information
Route::get('group-information-frontend/{id}', 'GroupInformationController@show');
// Download attachments
Route::get('/csv-download/{file}', function ($file) {
    return response()->download(public_path('csv/'.$file));
});

//Route::get('download-file', 'GroupInformationController@getDownlaodData');