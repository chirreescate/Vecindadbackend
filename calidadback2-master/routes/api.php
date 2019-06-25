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

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');

    Route::group([
        'middleware' => 'auth:api'
    ], function() {
        //Users
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
        Route::get('notifications', 'AuthController@notifications');
        Route::post('notifications/{id}/read', 'AuthController@readNotification');
        //Residents
        Route::get('residents', 'ResidentController@list');
        Route::post('resident/create','UserController@createResident');
        Route::post('resident/{id}/delete', 'UserController@deleteResident');
        Route::post('resident/{id}/generatePassword', 'UserController@generatePassword');
        //Roles
        Route::post('role/create','RoleController@create');
        Route::post('role/update/{id}','RoleController@update');
        Route::get('roles','RoleController@list');
        Route::get('role/{id}','RoleController@role');
        //Common Areas
        Route::post('commonArea/create','CommonAreaController@create');
        Route::post('commonArea/update/{id}','CommonAreaController@update');
        Route::get('commonAreas','CommonAreaController@list');
        Route::get('commonArea/{id}','CommonAreaController@commonArea');
        //Reservations
        Route::get('reservations','ReservationController@list');
        Route::post('reserve','ReservationController@reserve');
        Route::post('reservation/{id}/changeStatus','ReservationController@change_status');
        Route::get('reservation/{id}','ReservationController@reservation');
        Route::post('reservation/delete/{id}','ReservationController@delete');
        //Events
        Route::get('event/{id}','EventController@get');
        //Tickets
        Route::post('ticket/{id}/changeStatus','TicketController@changeStatus');
        Route::post('ticket/create','TicketController@create');
        Route::get('ticket/{id}','TicketController@ticket');
        Route::get('tickets','TicketController@list');
        //Comments
        Route::post('comment/create','CommentController@create');
        Route::get('comments/{id}','CommentController@listByTicket');
        //Invitations
        Route::post('invitation/{id}/changeStatus','InvitationController@changeStatus');
        Route::get('invitation/{id}/guests','GuestController@listByInvitation');
        Route::post('invitation/create','InvitationController@create');
        Route::post('invitation/{id}/addGuest','InvitationController@addGuest');
        Route::get('invitations','InvitationController@list');
        Route::get('invitations/byEvent/{id}','InvitationController@listByEvent');
        Route::get('invitation/{id}','InvitationController@invitation');
        Route::post('invitation/update/{id}','InvitationController@update');
        Route::post('invitation/delete/{id}','InvitationController@delete');
        Route::post('invitations/search','InvitationController@search');
        //Guests
        Route::post('guest/create','GuestController@create');
        Route::post('guest/update/{id}','GuestController@update');
        //Route::get('guests','GuestController@list')
        Route::get('guest/{id}','GuestController@guest');
        //Ticket States
        Route::post('ticketStatus/create','TicketStatusController@create');
        Route::post('ticketStatus/update/{id}','TicketStatusController@update');
        Route::get('ticketStates','TicketStatusController@list');
        Route::get('ticketStatus/{id}','TicketStatusController@ticketStatus');
        //Ticket Categories
        Route::get('ticketCategories','TicketCategoryController@list');
        //Departments
        Route::get('departmentsByEdifice','DepartmentController@listByEdifice');
    });
});
