<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;

class CryptoController extends Controller
{
    public function store(Request $request, $id)
    { 
       
        
        $crypto = User::find($id);
        $suma=$crypto->currency;
$crypto->currency = $request->get('kiekis') + $suma;

$crypto->save();
return redirect()->back();
      
    }
}
