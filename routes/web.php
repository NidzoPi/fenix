<?php

use Illuminate\Support\Facades\Route;
use App\Mail\NewUserWelcomeMail;

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

Route::get('/', 'WelcomeController@index');

Auth::routes();

Route::get('/email', function(){
	return new NewUserWelcomeMail();
});

// Posts
Route::get('/p/create', 'PostsController@create');
Route::get('/p/{post}', 'PostsController@show');
Route::post('/p', 'PostsController@store');
Route::get('/p/{post}/edit', 'PostsController@edit');
Route::patch('/p/{post}', 'PostsController@update');

// Profile
Route::get('/profile/{user}', 'OrganizationsController@index')->name('profile.show');
Route::get('/profile/{user}/edit', 'OrganizationsController@edit')->name('profile.edit');
Route::patch('/profile/{user}', 'OrganizationsController@update')->name('profile.update');

// Volunteers
Route::get('/v/create', 'VolunteersController@create');
Route::get('/v/all', 'VolunteersController@showAll');
Route::get('/v/{volunteer}', 'VolunteersController@show');
Route::post('/v', 'VolunteersController@store');
Route::get('/v/{volunteer}/edit', 'VolunteersController@edit');
Route::patch('/v/{volunteer}', 'VolunteersController@update');

//Add hours
Route::get('/{post}/h/create', 'HoursController@create');
Route::post('/h', 'HoursController@store');
//Route::get('/h/v', 'HoursController@showInAction');