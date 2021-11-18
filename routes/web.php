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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/profile', function () {
    $variable = 'Naudotojo profilis';
    return view('profile', compact('variable'));
});

Route::get('/test', function () {
    return view('test');
});

//Sprendimų stuff

Route::get('/myTestsList', 'App\Http\Controllers\PostController@index')->name('posts');
Route::get('/testsList', 'App\Http\Controllers\PostController@otherindex')->name('otherpostss');

Route::get('/myTestsList/testInfo/{idTest}', 'App\Http\Controllers\PostController@show')->name('postshow');
Route::delete('/myTestsList/delete/{idTest}', 'App\Http\Controllers\PostController@destroy')->name('postdestroy');

Route::get('/testCreate', 'App\Http\Controllers\PostController@create')->name('testcreate');
Route::post('/testCreate/store', 'App\Http\Controllers\PostController@store')->name('poststore');

Route::get('/myTestsList/testInfo/{idTest}/testEdit', 'App\Http\Controllers\PostController@edit')->name('postedit');
Route::match(['put','patch'],'{idTest}/testEdit', 'App\Http\Controllers\PostController@update')->name('postupdate');

Route::get('/testsList/testInfo/{idTest}/test/{kelintas}', 'App\Http\Controllers\PostController@testSolution')->name('testdo');
Route::post('/testsList/testInfo/{idTest}/test/{kelintas}', 'App\Http\Controllers\PostController@testSolutionV2')->name('testdov2');
Route::post('/testsList/testInfo/{idTest}/test/{kelintas}/answer', 'App\Http\Controllers\PostController@testAnswers')->name('testansw');



Route::get('/login', function () {
    return view('login');
});

Route::get('/statistics', function () {
    return view('statistics');
});

Route::get('/followingList', function() {
    return view('followingList');
});

Route::get('/header', function() {
    return view('header');
});

//AUTH-----------------------------------------------------
Auth::routes(['verify' => true]);

Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
Route::get('auth/google', 'App\Http\Controllers\Auth\GoogleController@redirectToGoogle');
Route::get('auth/google/callback', 'App\Http\Controllers\Auth\GoogleController@handleGoogleCallback');


Route::get('/', 'App\Http\Controllers\ProfileController@index')->name('userProfile');

Route::get('/profile/{id}', 'App\Http\Controllers\ProfileController@show')->name('profileshow');

Route::post('/profile/{id}/currency', 'App\Http\Controllers\CryptoController@store')->name('addCur');