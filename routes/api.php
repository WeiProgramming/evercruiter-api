<?php

use Illuminate\Http\Request;
use App\User;
use App\Role;

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

Route::post('register', 'UserController@register');
Route::post('login', 'UserController@authenticate');
Route::get('open', 'DataController@open');
Route::get('createroles', function(){
    $candidate= new Role();
    $candidate->name         = 'candidate';
    $candidate->display_name = 'Candidate Member'; // optional
    $candidate->description  = 'User is a candidate'; // optional
    $candidate->save();

    $recruiter = new Role();
    $recruiter->name         = 'recruiter';
    $recruiter->display_name = 'Recruiter Member'; // optional
    $recruiter->description  = 'User is a recruiter on the platform'; // optional
    $recruiter->save();
});
Route::get('generate', function() {
    $roleId = Role::where('name','recruiter')->get(['id']);
    $user = User::where('name','cyrus')->first();
    $user->roles()->attach($roleId);
    return response()->json(compact('user'));
});

Route::group(['middleware' => ['ability:recruiter,add-users']], function() {
    Route::get('user', 'UserController@getAuthenticatedUser');
    Route::get('closed', 'DataController@closed');
    Route::get('interviews','\App\Http\Controllers\InterviewController@index');
    Route::post('interviews','\App\Http\Controllers\InterviewController@store');
    Route::post('interviews/{id}','\App\Http\Controllers\InterviewController@update');
});