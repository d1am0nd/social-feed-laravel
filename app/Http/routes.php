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

Route::get('/', 'GeneralController@getFeed');

Route::get('fb', 'GeneralController@getFb');
Route::get('tw', 'GeneralController@getTw');
Route::get('insta', 'GeneralController@getInsta');

Route::get('cache', 'GeneralController@checkCache');

Route::get('delete', function() {
    \Cache::pull('twitter');
    \Cache::pull('facebook');
    \Cache::pull('instagram');
    return redirect(action('GeneralController@checkCache'));
});