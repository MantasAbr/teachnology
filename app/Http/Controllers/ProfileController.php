<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Session;
use Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $userProfile = User::all(); // i kintamaji padedami visi user lenteles duomenys   
        //dd($userProfile); 
        return view('welcome', compact('userProfile')); // db duomenys profilio view'se
    }

    public function show($id)
    {
        $usersProfile = User::find($id);
        return view('profile', compact('usersProfile'));
    }
}