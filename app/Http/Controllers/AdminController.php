<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    function show()
    {
       
     
        //$adminProfile = User::find($id);
        $data = user::all();

        return view('admin', ['users' => $data]);

    }
   

    public function showUser($user)
    {
        $usersProfile = User::find($user);
        return view('profile', compact('usersProfile'));
       
    }
}
