<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Category;
use Auth;
use Session;
use Validator;

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
            'info' => 'required'

        ]);
        $post = Post::findOrFail($id);
        $testName = $request->input('testName');
        $info = $request->input('info');
        $post->testName = $testName;
        $post->info = $info;


        $post->save();
        return redirect()->route('posts')->with('status','Testo informacija atnaujinta');
    }
    public function create()
    {
        $category =  Category::all();
        //dd($category);
        return view('testCreate', compact('category'));
    }
    public function store(Request $request)
    {
        $post = new Post;
        $post->testName = $request->get('testName');
        $post->info = $request->get('info');
        $post->Category_idCategory = $request->get('category');
        $post->User_idUser = Auth::user()->id;
        $post->save();

        //klausimų pridėjimas

            $rules = array(
                'question.*' => 'required',
                'weight.*' => 'required'
            );
            $error = Validator::make($request->all(), $rules);
            if ($error->fails()) {
                return response()->json([
                    'error' => $error->errors()->all()
                ]);
            }

            $question = $request->question;
            $weight = $request->weight;
           // dd($weight);

            for ($count = 0; $count < count($question); $count++) {
                $data = array(
                    'question' => $question[$count],
                    'weight' => $weight[$count],
                    'Test_idTest' => $post->idTest
                );
                $insert_data[] = $data;
            }


            Question::insert($insert_data);


        return redirect()->route('posts');

    }
}
