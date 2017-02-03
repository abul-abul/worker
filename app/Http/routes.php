<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'UsersController@getDashboard');
Route::get('active/{token}', 'UsersController@activeProfile');
Route::get('city/{code}', 'UsersController@getCity');
Route::get('privacy', 'PrivacyController@showPage');
Route::get('terms', 'TermsController@showPage');
Route::get('contact', 'ContactController@showPage');
Route::post('send-email', 'ContactController@postSendEmail');

// Route::get('admin/users', 'AdminController@usersPageShow');
// Route::get('admin/tasks', 'AdminController@tasksPageShow');

// Route::post('/admin/user-add', 'AdminController@userAdd');
// Route::post('/admin/user-delete', 'AdminController@userDelete');

Route::controller('users', 'UsersController');
Route::controller('seeker', 'SeekersController');
Route::controller('provider', 'ProvidersController');
Route::controller('admin', 'AdminController');
// Route::post('/ajax-upload-user/','UsersController@postAjaxAddPhoto');
Route::post('/ajax-upload-profile/','UsersController@postAjaxAddPhoto');

