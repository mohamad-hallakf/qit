<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/notify', [App\Http\Controllers\UserController::class, 'getNotifications']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/guest', [App\Http\Controllers\HomeController::class, 'guest'])->name('welcome');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
    Route::get('table-list', function () {
        return view('pages.table_list');
    })->name('table');

    Route::get('typography', function () {
        return view('pages.typography');
    })->name('typography');

    Route::get('icons', function () {
        return view('pages.icons');
    })->name('icons');

    Route::get('map', function () {
        return view('pages.map');
    })->name('map');

    Route::get('notifications', function () {
        return view('pages.notifications');
    })->name('notifications');

    Route::get('rtl-support', function () {
        return view('pages.language');
    })->name('language');

    Route::get('upgrade', function () {
        return view('pages.upgrade');
    })->name('upgrade');
});

Route::group(['middleware' => 'auth'], function () {
    Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});
    /*
    *
    *  Notification Routes
    *
    * ---------------------------------------------------------------------
    */
    $module_name = 'notifications';
    $controller_name = 'App\Http\Controllers\NotificationsController';
    Route::get("$module_name", ['as' => "$module_name.index", 'uses' => "$controller_name@index"]);
    Route::get("$module_name/markAllAsRead", ['as' => "$module_name.markAllAsRead", 'uses' => "$controller_name@markAllAsRead"]);
    Route::delete("$module_name/deleteAll", ['as' => "$module_name.deleteAll", 'uses' => "$controller_name@deleteAll"]);
    Route::get("$module_name/{id}", ['as' => "$module_name.show", 'uses' => "$controller_name@show"]);
/*
     *
     *  service Routes
     *
     * ---------------------------------------------------------------------
     */
    $model_name = 'service';
    $controller_name = 'App\Http\Controllers\ServiceController';
        Route::get("$model_name/",''.$controller_name.'@index')->name('service.index');
        Route::post("$model_name/create", ''.$controller_name.'@create')->name('service.create');
        Route::post("$model_name/store", ''.$controller_name.'@store')->name('service.store');
        Route::post("$model_name/update", ''.$controller_name.'@update')->name('service.update');
        Route::post("$model_name/destroy", ''.$controller_name.'@destroy')->name('service.destroy');
        Route::post("$model_name/edit", ''.$controller_name.'@edit')->name('service.edit');
/*
     *
     *  child Routes
     *
     * ---------------------------------------------------------------------
     */
        $model_name = 'child';
        $controller_name = 'App\Http\Controllers\ChildController';
        Route::get("$model_name/",''.$controller_name.'@index')->name('child.index');
        Route::get("$model_name/mychildren",''.$controller_name.'@mychildren')->name('child.mychildren');
        Route::post("$model_name/create", ''.$controller_name.'@create')->name('child.create');
        Route::post("$model_name/store", ''.$controller_name.'@store')->name('child.store');
        Route::post("$model_name/update", ''.$controller_name.'@update')->name('child.update');
        Route::post("$model_name/destroy", ''.$controller_name.'@destroy')->name('child.destroy');
        Route::post("$model_name/edit", ''.$controller_name.'@edit')->name('child.edit');
/*
     *
     *  question Routes
     *
     * ---------------------------------------------------------------------
     */
    $model_name = 'question';
    $controller_name = 'App\Http\Controllers\QuestionsController';
    Route::get("$model_name/",''.$controller_name.'@index')->name('question.index');
    Route::get("$model_name/mychildren",''.$controller_name.'@mychildren')->name('question.mychildren');
    Route::post("$model_name/create", ''.$controller_name.'@create')->name('question.create');
    Route::post("$model_name/store", ''.$controller_name.'@store')->name('question.store');
    Route::post("$model_name/update", ''.$controller_name.'@update')->name('question.update');
    Route::post("$model_name/destroy", ''.$controller_name.'@destroy')->name('question.destroy');
    Route::post("$model_name/edit", ''.$controller_name.'@edit')->name('question.edit');
