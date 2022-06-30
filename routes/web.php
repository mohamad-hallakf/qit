<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;


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



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/guest', [App\Http\Controllers\HomeController::class, 'guest'])->name('welcome');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');


Route::group(['middleware' => 'auth'], function () {
    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);

    $model_name = 'user';
    $controller_name = 'App\Http\Controllers\UserController';
    Route::get("$model_name/", '' . $controller_name . '@index')->name('' . $model_name . '.index');
    Route::get("$model_name/userMarks", '' . $controller_name . '@marks')->name('' . $model_name . '.marks');
    Route::post("$model_name/store", '' . $controller_name . '@store')->name('' . $model_name . '.store');
    Route::post("$model_name/update", '' . $controller_name . '@update')->name('' . $model_name . '.update');
    Route::post("$model_name/destroy", '' . $controller_name . '@destroy')->name('' . $model_name . '.destroy');
    Route::post("$model_name/edit", '' . $controller_name . '@edit')->name('' . $model_name . '.edit');



    $model_name = 'test';
    $controller_name = 'App\Http\Controllers\testController';
    Route::get("$model_name/", '' . $controller_name . '@index')->name('' . $model_name . '.index');
    Route::post("$model_name/store", '' . $controller_name . '@store')->name('' . $model_name . '.store');
    Route::post("$model_name/destroy", '' . $controller_name . '@destroy')->name('' . $model_name . '.destroy');
    Route::post("$model_name/show", '' . $controller_name . '@show')->name('' . $model_name . '.show');
    Route::post("$model_name/getQuestion", '' . $controller_name . '@getQuestion')->name('' . $model_name . '.getQuestion');
    Route::post("$model_name/applyTest", '' . $controller_name . '@applyTest')->name('' . $model_name . '.applyTest');
    Route::get("$model_name/apply/{id}", '' . $controller_name . '@apply')->name('' . $model_name . '.apply');
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
     *  child Routes
     *
     * ---------------------------------------------------------------------
     */
$model_name = 'child';
$controller_name = 'App\Http\Controllers\ChildController';
Route::get("$model_name/", '' . $controller_name . '@index')->name('child.index');
Route::get("$model_name/mychildren", '' . $controller_name . '@mychildren')->name('child.mychildren');
Route::post("$model_name/create", '' . $controller_name . '@create')->name('child.create');
Route::post("$model_name/store", '' . $controller_name . '@store')->name('child.store');
Route::post("$model_name/update", '' . $controller_name . '@update')->name('child.update');
Route::post("$model_name/destroy", '' . $controller_name . '@destroy')->name('child.destroy');
Route::post("$model_name/edit", '' . $controller_name . '@edit')->name('child.edit');
/*
     *
     *  question Routes
     *
     * ---------------------------------------------------------------------
     */
$model_name = 'question';
$controller_name = 'App\Http\Controllers\QuestionsController';
Route::get("$model_name/", '' . $controller_name . '@index')->name('question.index');
Route::get("$model_name/questions", '' . $controller_name . '@questions')->name('question.questions');
Route::post("$model_name/create", '' . $controller_name . '@create')->name('question.create');
Route::post("$model_name/store", '' . $controller_name . '@store')->name('question.store');
Route::post("$model_name/update", '' . $controller_name . '@update')->name('question.update');
Route::post("$model_name/answer", '' . $controller_name . '@answer')->name('question.answer');
Route::post("$model_name/destroy", '' . $controller_name . '@destroy')->name('question.destroy');
Route::post("$model_name/edit", '' . $controller_name . '@edit')->name('question.edit');
Route::post("$model_name/accept", '' . $controller_name . '@accept')->name('question.accept');
