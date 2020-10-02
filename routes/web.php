<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::redirect('/', '/login')->name('index');


//Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
//Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
//Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

Auth::routes(['verify'=>true]);

Route::get('/home', function() {
    return view('admin.dashboard');
})->name('home')->middleware('auth', 'verified');



Route::middleware('verified')->group(function () {
//Profile routes
    Route::group(['prefix' => '/profile'], function() {
        Route::get('/', [
            'as' => 'profile',
            'uses' => 'ProfileController@edit',
        ]);

        Route::put('/', [
            'as' => 'profile.update',
            'uses' => 'ProfileController@update',
        ]);

        Route::put('/update/password', [
            'as' => 'profile.update.password',
            'uses' => 'ProfileController@updatePassword',
        ]);
    });

    Route::get('/dashboard', [
        'as' => 'dashboard',
        'uses' => 'DashboardController@index',
    ])->where(['name' => 'dashboard|index']);


    Route::group(['prefix' => 'users', 'as' => 'users.', 'middleware' => 'isAdmin'], function() {
        // User Datatables
        Route::get('/datatable', [
            'as' => 'datatable',
            'uses' => 'UserController@datatable',
        ]);

        // User CRUD
        Route::get('/', [
            'as' => 'index',
            'uses' => 'UserController@index',
        ]);

        Route::get('/create', [
            'as' => 'create',
            'uses' => 'UserController@create',
        ]);

        Route::post('/', [
            'as' => 'store',
            'uses' => 'UserController@store',
        ]);

        Route::get('/{user}/edit', [
            'as' => 'edit',
            'uses' => 'UserController@edit',
        ]);

        Route::put('/{user}', [
            'as' => 'update',
            'uses' => 'UserController@update',
        ]);

        Route::delete('/{user}', [
            'as' => 'destroy',
            'uses' => 'UserController@destroy',
        ]);
    });

    Route::group(['prefix' => 'fields', 'as' => 'fields.', 'middleware' => 'isAdmin'], function() {
        // Fields Datatables
        Route::get('/datatable', [
            'as' => 'datatable',
            'uses' => 'FieldController@datatable',
        ]);

        // Field CRUD
        Route::get('/', [
            'as' => 'index',
            'uses' => 'FieldController@index',
        ]);

        Route::get('/create', [
            'as' => 'create',
            'uses' => 'FieldController@create',
        ]);

        Route::post('/', [
            'as' => 'store',
            'uses' => 'FieldController@store',
        ]);

        Route::get('/{field}/edit', [
            'as' => 'edit',
            'uses' => 'FieldController@edit',
        ]);

        Route::put('/{field}', [
            'as' => 'update',
            'uses' => 'FieldController@update',
        ]);

        Route::delete('/{field}', [
            'as' => 'destroy',
            'uses' => 'FieldController@destroy',
        ]);

    });

    Route::group(['prefix' => 'events', 'as' => 'events.'], function() {
        //Events Calendar
        Route::get('/calendar', [
            'as' => 'calendar',
            'uses' => 'EventController@calendar',
        ]);

        // Events Datatables
        Route::get('/datatable', [
            'as' => 'datatable',
            'uses' => 'EventController@datatable',
        ]);


        // Event CRUD
        Route::get('/', [
            'as' => 'index',
            'uses' => 'EventController@index',
        ]);

        Route::get('/{event}/edit', [
            'as' => 'edit',
            'uses' => 'EventController@edit',
        ]);

        Route::post('/getFreeEvents', [
            'as' => 'getFreeEvents',
            'uses' => 'EventController@getFreeEvents',
        ]);

        Route::post('/', [
            'as' => 'store',
            'uses' => 'EventController@store',
        ]);

        Route::put('/{event}', [
            'as' => 'update',
            'uses' => 'EventController@update',
        ]);

        Route::delete('/{event}', [
            'as' => 'destroy',
            'uses' => 'EventController@destroy',
        ]);

        Route::get('/dates_month/{month}/{year}', [
            'as' => 'dates_month',
            'uses' => 'EventController@dates_month',
        ]);
    });
});




