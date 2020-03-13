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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/email', function(){
	return new NewUserWelcomeMail();
});

// Posts
Route::get('/p/create', 'PostsController@create');
Route::get('/p/{post}', 'PostsController@show');
Route::post('/p', 'PostsController@store');

// Profile
Route::get('/profile/{user}', 'OrganizationsController@index')->name('profile.show');
Route::get('/profile/{user}/edit', 'OrganizationsController@edit')->name('profile.edit');
Route::patch('/profile/{user}', 'OrganizationsController@update')->name('profile.update');