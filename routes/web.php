<?php

Route::get('/auth/facebook', 'Auth\SocialAuthController@redirectToProviderFb');
Route::get('/auth/facebook/callback', 'Auth\SocialAuthController@handleProviderCallbackFb');

Route::get('/auth/vkontakte', 'Auth\SocialAuthController@redirectToProviderVk');
Route::get('/auth/vkontakte/callback', 'Auth\SocialAuthController@handleProviderCallbackVk');

Route::get('/', 'AppController@main');
Route::get('news', 'AppController@news');
Route::get('news/{id}', 'AppController@shownews');
Route::get('league/{id}', 'AppController@leagueTable');
Route::get('calendar/{id}', 'AppController@calendar');
Route::get('team/{id}', 'AppController@team');
//........................................
Route::resource('player', 'PlayerController');


Route::put('userAddResult', 'UserAddResultController@updateResult')->middleware('is_auth');
Route::post('league/userConfirmResult', 'UserAddResultController@confirmResult')->middleware('is_auth');
Route::post('calendar/addGame', 'UserMatchController@addGame')->middleware('is_auth');
Route::get('calendar/destroy/{id}', 'UserMatchController@destroy')->middleware('is_auth');

//-----admin routes-----------------------
Route::group(['middleware' => 'is_admin'], function()
{
//    Route::get('admin', 'Admin\AdminController@index');
    Route::resource('admin-teams', 'Admin\TeamController');
    Route::resource('admin-leagues', 'Admin\LeagueController');
    Route::resource('admin-league', 'Admin\LeagueTablesController');
    Route::resource('admin-calendar', 'Admin\CalendarController');
    Route::resource('admin-news', 'Admin\PostsController');

    Route::get('clear-result/{id}', 'Admin\CalendarController@clearResult');

    Route::put('league-show', 'Admin\LeagueController@toggleLeagueShow');

});
//-----------------------------------------

Route::group(['middleware' => 'is_super_admin'], function() {
    Route::resource('admin-users', 'Admin\UserController');
    Route::put('user-ban', 'Admin\UserController@toggleUserBan');
    Route::put('user-admin', 'Admin\UserController@toggleUserAdmin');
});



Auth::routes();


