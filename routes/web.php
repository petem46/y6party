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

Route::group(['domain' => 'demo.y6party.com'], function () {
    


// Authentication Routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

Route::group(['middleware' => 'App\Http\Middleware\AdminMiddleware'], function()
{
    Route::resource('settings', 'SettingsController');    
    Route::get('/iamjob', 'JobsController@index')->name('iamjob'); 
    Route::get('/addjob', 'JobsController@create')->name('addjob');
    Route::post('/jobs/{job}/comments', 'CommentsController@store');
    Route::resource('jobs', 'JobsController');    
    Route::post('/jobs/{job}/updatejob', 'JobsController@updatejob');
    Route::resource('comments', 'CommentsController');    
});

Route::group(['middleware' => 'App\Http\Middleware\ParentMiddleware'], function()
{
    Route::get('/iamjob', 'JobsController@index')->name('iamjob'); 
    Route::get('/addjob', 'JobsController@create')->name('addjob');
    Route::post('/jobs/{job}/comments', 'CommentsController@store');
    Route::resource('jobs', 'JobsController');    
    Route::post('/jobs/{job}/updatejob', 'JobsController@updatejob');
    Route::resource('comments', 'CommentsController');    
    Route::get('/profile', 'ProfileController@show')->name('profile'); 
    Route::get('/playlist', 'SongsController@index')->name('playlist'); 
    Route::get('/party', 'HomeController@index')->name('party');

});

Route::group(['middleware' => 'auth'], function () {

    Route::get('auth/register', 'Auth\AuthController@getRegister');
    Route::post('auth/register', 'Auth\AuthController@postRegister');
    
    Route::get('/profile', 'ProfileController@show')->name('profile'); 
    Route::get('/playlist', 'SongsController@index')->name('playlist'); 
    Route::get('/party', 'HomeController@index')->name('party');
    Route::post('/songsearch', 'SongsController@songsearch')->name('songsearch');

    Route::get('/addsong', 'SongsController@create')->name('addsong');
    Route::get('/songs/search', 'SongsController@search');
    Route::get('/songs/search/{search}', 'SongsController@songsearch');
    
    Route::resource('songs', 'SongsController');

});
    
// Home Routes
Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    return view('welcome');
})->name('home');
Auth::routes();
    
});