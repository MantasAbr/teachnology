<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
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

Route::get('/testsList', function () {
    return view('testsList');
});
Route::get('/testInfo', function () {
    return view('testInfo');
});
Route::get('/test', function () {
    return view('test');
});
Route::get('/testCreate', function () {
    return view('testCreate');
});

Route::get('/myTestsList', function () {
    return view('myTestsList');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/statistics', function () {
    return view('statistics');
});

Route::get('/followingList', function() {
    return view('followingList');
});

Route::get('/testEdit', function() {
    return view('testEdit');
});

//AUTH-----------------------------------------------------
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
Route::get('auth/google', 'App\Http\Controllers\Auth\GoogleController@redirectToGoogle');
Route::get('auth/google/callback', 'App\Http\Controllers\Auth\GoogleController@handleGoogleCallback');
