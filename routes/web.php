<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\GoogleController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Answer;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\DB;
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

Route::get('/', 'App\Http\Controllers\ProfileController@index')->name('userProfile');

//Route::get('/header', 'App\Http\Controllers\HeaderController@index')->name('userProfileS');

Route::get('/profile/{id}', 'App\Http\Controllers\ProfileController@show')->name('profileshow');
Route::get('/profile', function () {
    $variable = 'Naudotojo profilis';
    return view('profile', compact('variable'));
});

Route::post('/profile/store', 'App\Http\Controllers\ProfileController@update')->name('UpdateProfile'); //Naudotojo profilio redagavimas
Route::post('/profile', 'App\Http\Controllers\ProfileController@updatePass')->name('UpdatePassword'); //Naudotojo slaptažodžio redagavimas

Route::get('/password/{id}', 'App\Http\Controllers\ProfileController@password')->name('password'); //Naudotojo slaptažodžio redagavimo forma


//idk what it is
Route::get('/testsList', 'App\Http\Controllers\TestsController@index')->name('userProfile');


Route::get('/test', function () {
    return view('test');
});
//Komentarai
Route::post('/myTestsList/testInfo/{idTest}/{idUser}', 'App\Http\Controllers\PostController@addComment')->name('addComment');


//Vartotojų ir kūrėjo testų rodymas

Route::get('/myTestsList', 'App\Http\Controllers\PostController@index')->name('posts');
Route::get('/testsList', 'App\Http\Controllers\PostController@otherindex')->name('otherpostss');

//Testų rodymas po sprendimo, testo įvertinimas(apskaičiavimai)
Route::get('/testsList/{id}/{mark}', 'App\Http\Controllers\PostController@testDone')->name('testdn');

//Testų rodymas, kūrimas ir ištrynimas
Route::get('/myTestsList/testInfo/{idTest}', 'App\Http\Controllers\PostController@show')->name('postshow');
Route::delete('/myTestsList/delete/{idTest}', 'App\Http\Controllers\PostController@destroy')->name('postdestroy');
Route::get('/testCreate', 'App\Http\Controllers\PostController@create')->name('testcreate');
Route::post('/testCreate/store', 'App\Http\Controllers\PostController@store')->name('poststore');

//Testų redagavimas
Route::get('/myTestsList/testInfo/{idTest}/testEdit', 'App\Http\Controllers\PostController@edit')->name('postedit');
Route::match(['put','patch'],'{idTest}/testEdit', 'App\Http\Controllers\PostController@update')->name('postupdate');
//Testų sprendimas
Route::get('/testsList/testInfo/{idTest}/test/{kelintas}', 'App\Http\Controllers\PostController@testSolution')->name('testdo');
Route::post('/testsList/testInfo/{idTest}/test/{kelintas}', 'App\Http\Controllers\PostController@testSolutionV2')->name('testdov2');
Route::post('/testsList/testInfo/{idTest}/test/{kelintas}/answer', 'App\Http\Controllers\PostController@testAnswers')->name('testansw');

//Route::post('/testInfo/testInfo/{idTest}', 'App\Http\Controllers\PostController@comment')->name('addComment');

Route::get('/login', function () {
    return view('login');
});
//Statistika
Route::get('/statistics','App\Http\Controllers\StatsController@index')->name('statsstuff');




//AUTH-----------------------------------------------------
Auth::routes(['verify' => true]);

Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');


Route::get('auth/google', 'App\Http\Controllers\Auth\GoogleController@redirectToGoogle');
Route::get('auth/google/callback', 'App\Http\Controllers\Auth\GoogleController@handleGoogleCallback');


Route::get('/', 'App\Http\Controllers\ProfileController@index')->name('userProfile');

Route::get('/profile/{id}', 'App\Http\Controllers\ProfileController@show')->name('profileshow');

Route::get('/profile/{userid}', 'App\Http\Controllers\AdminController@showUser')->name('showUser');


Route::post('/profile/{id}/currency', 'App\Http\Controllers\CryptoController@store')->name('addCur');

Route::get('/admin/{id}', 'App\Http\Controllers\AdminController@show')->name('adminshow');




Route::post('/myTestsList/testInfo/{idTest}/{idComment}/edit', 'App\Http\Controllers\PostController@updateComment')->name('updateComment');

Route::get('/myTestsList/testInfo/{idTest}/{idComment}/delete', 'App\Http\Controllers\PostController@deleteComment')->name('deleteComment');



Route::middleware('auth')->group(function(){
    Route::resource('home', App\Http\Controllers\HomeController::class);
    Route::get('/profile/{id}/{status_code}', 'App\Http\Controllers\ProfileController@updateStatus')->name('status');

});
