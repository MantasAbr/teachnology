<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Session;
use Auth;

class TestsController extends Controller
{
    public function index()
    {
       $userProfile = User::all(); // i kintamaji padedami visi user lenteles duomenys   
        //dd($userProfile); 
    return view('testsList', compact('userProfile')); // db duomenys profilio view'se
    }
}