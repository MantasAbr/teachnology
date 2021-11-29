<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class StatsController extends Controller
{
    public function index (){
        $test = Post::all();
        //Top 5 geriausiai įvertinti
        $result = $test->sortByDesc(function ($product, $key) {
            if($product['ratingSum'] > 0) {
                return ($product['ratingSum'] / $product['ratingCount']);
            }
            else{
                return 0;
            }
        });
        $results = $result->values()->take(5);
        //dd($result);
        //Top 5 daugiausiai kartų spręsti
        $complet = $test->sortByDesc('completedCount');
        $complet = $complet->values()->take(5);
        //top 5 aktyviausi vartotojai
        $user = User::all();
        $userTest = $user->sortByDesc('testCount');
        $userTest = $userTest->values()->take(5);
        //top 5 protingiausi vartotojai
        $userSmart = $user->sortByDesc(function ($product, $key) {
            if($product['ratingSum'] > 0) {
                return ($product['testMarkSum'] / $product['testCount']);
            }
            else{
                return 0;
            }
        });
        $userSmart = $userSmart->values()->take(5);
        //dd($userSmart);
        return view('statistics', compact('results', 'complet', 'userTest', 'userSmart'));
    }
}
