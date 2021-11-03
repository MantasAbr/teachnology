<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use Auth;
use Session;

class PostController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }
    public function index()
    {
        $posts = Post::all();
        return view('myTestsList', compact('posts'));
    }
    public function show($id)
    {
        $post = Post::find($id);
        if($post->ratingSum != null) {
            $avarage = $post->ratingSum / $post->ratingCount;
        }
        else{
            $avarage = 0;
        }
        return view('testInfo', compact('post'))->with('avarage', $avarage);
    }
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('posts')->with('status','Pasirinktas testas ištrintas');
    }
    public function edit($id){

        $post = Post::find($id);
        return view('testEdit',compact('post')); //->with('messages','id');
    }
    public function update(Request $request,$id){

        $this->validate($request, [
            'testName' => 'required',
            'info' => 'required',
            'Category_idCateogry' => 'required'

        ]);
        $post = Post::findOrFail($id);
        dd($id);
        $testName = $request->input('testName');
        $info = $request->input('info');
        $Category_idCateogry = $request->input('Category_idCateogry');
        $post->testName = $testName;
        $post->info = $info;
        $post->Category_idCateogry = $Category_idCateogry;

        $post->save();
        dd($post);
        return redirect()->route('posts')->with('status','Testo informacija atnaujinta');
    }
}
