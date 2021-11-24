<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
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

    public function password($id)
    {
        $usersProfile = User::find($id); 
        //dd($userProfile); 
        $status = null;
        return view('password', compact('usersProfile'))->with('status',  $status); // db duomenys profilio view'se
    }

 
    public function updatePass(Request $request){

        $password = $request->get('password');
        $password_confirmation= $request->get('password_confirmation');
        $id = Auth::user()->id;

        $usersProfile = User::find($id); 

        if( $password != $password_confirmation)
        {
            $status = "Slaptažodiai nesutampa";
            return view('password', compact('usersProfile'))->with('status',  $status);
        }
        else{
            $hashedPass = Hash::make($password);

            User::where('id',$id)->update(['password' => $hashedPass]);
    
            $usersProfile = User::find($id);
            return view('profile', compact('usersProfile'));
        }
    }

    public function show($id)
    {
        $usersProfile = User::find($id);
        return view('profile', compact('usersProfile'));
    }

    public function update(Request $request/*, $id*/){

        $name = $request->get('name');
        $surname= $request->get('surname');
        $email = $request->get('email');
        
        
        $id = Auth::user()->id;

        User::where('id',$id)->update(['name' => $name,'surname' => $surname, 'email' => $email]);

        $usersProfile = User::find($id);
        return view('profile', compact('usersProfile'));
    }
}