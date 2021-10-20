<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Socialite;
use Auth;
use Exception;
use App\Models\User;
use Carbon\Carbon;

class GoogleController extends Controller
{
    /**
     * @return void
     */
    public function redirectToGoogle()// Nutelina į google
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * @return void
     */
    public function handleGoogleCallback() // gauna userio login iš googles
    {
        $now = Carbon::now()->toDateTimeString();
        //dd($now->toDateTimeString());
        try {
            $user = Socialite::driver('google')->user();
            $finduser = User::where('google_id', $user->id)->first();
            if ($finduser) {
                Auth::login($finduser);
                return redirect('/home');
            }
            else {
                $newUser = User::create([
                    'name' => $user->user['given_name'],
                    'surname'=> $user->user['family_name'],
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'password' => encrypt('123456dummy'),
                ]);
                $newUser->email_verified_at = date('Y-m-d H:i:s');
                $newUser->save();
                Auth::login($newUser);
                return redirect('/home');
            }
        }catch (Exception $e){
            return redirect('auth/google');
        }
    }
}
