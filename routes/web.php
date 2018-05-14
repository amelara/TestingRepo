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

	// Information

    Route::get('/', 'InfoController@index')->name('index');

	Route::get('/terms', 'InfoController@terms')->name('terms');

	Route::get('/privacy', 'InfoController@privacy')->name('privacy');

	Route::get('/refund', 'InfoController@refund')->name('refund');

	// Credit Card Lookup

	Route::post('/cc-lookup-process', 'AccountController@cc_lookup')->name('cclookup');	

	// Account Lookup

	Route::get('/lookup-form', 'AccountController@lookup')->name('lookup');

	Route::post('/lookup-process', 'AccountController@search')->name('search');

	Route::get('/result', 'AccountController@result')->name('result');

	// Cancel Account

	Route::get('/cancel-form', 'AccountController@cancel')->name('cancel');

	Route::post('/login', 'AccountController@login')->name('login');

	Route::get('/confirmation', 'AccountController@confirmation')->name('confirmation');

	Route::post('/selection-process', 'AccountController@process')->name('process');

	Route::get('/cancellation', 'AccountController@cancellation')->name('cancellation');

	Route::get('/membership', 'AccountController@membership')->name('membership');
