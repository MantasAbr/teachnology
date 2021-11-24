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

    
    public function updateStatus($id, $status_code)
    {
        try{
            $update_user = User::whereId($id)->update([
                'is_blocked' => $status_code
            ]);
            if($update_user){
                return redirect()->back()->with('success', 'Sėkmingai pakeitėte naudotojo statusą.');
            }
            return redirect()->back()->with('error', 'Blogai');

        }
        catch (\Throwable $th){
            throw $th;
        }

    }
}