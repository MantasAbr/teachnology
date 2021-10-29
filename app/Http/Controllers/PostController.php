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
        return view('show', compact('post'));
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
}
