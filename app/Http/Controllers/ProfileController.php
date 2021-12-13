<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
Use Carbon\Carbon;
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
    public function premium(){
        $id = Auth::User()->id;
        $mytime = Carbon::now()->toDateTimeString();
        $endtime = Carbon::now();
        $endtime->addDays(30);
        $endtime->toDateTimeString();
        $usersProfile = User::find($id);
        if($usersProfile->currency >= 5) {
            $money = $usersProfile->currency - 5;
            User::where('id', $id)->update(['premiumBought' => $mytime]);
            User::where('id', $id)->update(['premiumEnds' => $endtime]);
            User::where('id', $id)->update(['currency' => $money]);
            $status = 'Jūs nusipirkote premium';
        }
        else{
            $status = 'Jum trūkstą valiutos';
        }

        return redirect()->route('userProfile')->with('status', $status);
    }
}
