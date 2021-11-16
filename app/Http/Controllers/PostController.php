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
    public function otherindex()
    {
        $otherposts = Post::all();
        return view('testsList', compact('otherposts'));
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
    public function destroy(Request $request,$id)
    {
        $quest = Question::where([ 'test_idTest' => $id])->pluck('idQuestion');
        //dd($quest);
        for ($count = 0; $count < count($quest); $count++) {
        $ans = Answer::where([ 'Question_idQuestion' => $quest[$count]]);
            $ans->delete();
            }
        $questdel = Question::where([ 'test_idTest' => $id]);
        $questdel->delete();
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('posts')->with('status','Pasirinktas testas ištrintas');
    }
    public function edit($id){

        $post = Post::find($id);
        //$question = Question::where([ 'test_idTest' => $id]);

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
                'weight.*' => 'required',
                'answer.*' => 'required',
                'is_Correct.*' => 'required',
                'answer1.*' => 'required',
                'is_Correct1.*' => 'required',
                'answer2.*' => 'required',
                'is_Correct2.*' => 'required',
                'answer3.*' => 'required',
                'is_Correct3.*' => 'required'
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
                $testID[$count] = $post->idTest;
                $data = array(
                    'question' => $question[$count],
                    'weight' => $weight[$count],
                    'Test_idTest' => $post->idTest
                );
                $insert_data[] = $data;
            }

        //dd($testID);
            Question::insert($insert_data);

            //Atsakymų pridėjiomas

        $answer = $request->answer;
        $is_Correct = $request->is_Correct;

        $answer1 = $request->answer1;
        $is_Correct1 = $request->is_Correct1;
        $answer2 = $request->answer2;
        $is_Correct2 = $request->is_Correct2;
        $answer3 = $request->answer3;
        $is_Correct3 = $request->is_Correct3;
        //dd($is_Correct);
        //dd($answer3);

        for ($count = 0; $count < count($answer); $count++) {
            $questID = Question::where([ 'test_idTest' => $testID[$count]])->first()->pluck('idQuestion');
                $data = array(
                    'answer' => $answer[$count],
                    'is_Correct' => $is_Correct[$count],
                    'Question_idQuestion' => $questID[$count]
                );


            $insert_data1[] = $data;
        }
        for ($count = 0; $count < count($answer1); $count++) {
            $questID = Question::where([ 'test_idTest' => $testID[$count]])->first()->pluck('idQuestion');
                $data = array(
                    'answer' => $answer1[$count],
                    'is_Correct' => $is_Correct1[$count],
                    'Question_idQuestion' => $questID[$count]
                );


            $insert_data2[] = $data;
        }
        for ($count = 0; $count < count($answer2); $count++) {
            $questID = Question::where([ 'test_idTest' => $testID[$count]])->first()->pluck('idQuestion');

                $data = array(
                    'answer' => $answer2[$count],
                    'is_Correct' => $is_Correct2[$count],
                    'Question_idQuestion' => $questID[$count]
                );


            $insert_data3[] = $data;
        }
        for ($count = 0; $count < count($answer3); $count++) {
            $questID = Question::where([ 'test_idTest' => $testID[$count]])->first()->pluck('idQuestion');

                $data = array(
                    'answer' => $answer3[$count],
                    'is_Correct' => $is_Correct3[$count],
                    'Question_idQuestion' => $questID[$count]
                );


            $insert_data4[] = $data;
        }


        Answer::insert($insert_data1);
        Answer::insert($insert_data2);
        Answer::insert($insert_data3);
        Answer::insert($insert_data4);

        return redirect()->route('posts');

    }
    public function testSolution($id, Request $request, $kelintas){
        session_start();
        $howmuch = Question::count();
        $questions = Question::where(['Test_idTest' => $id])->take(1)->get();

        $questionsid = Question::where(['Test_idTest' => $id])->pluck('idQuestion');
        $answers = Answer::where(['Question_idQuestion' => $questionsid[0]])->get(); // ga padaryti, kad vietoj nulio keistusi reikšmė


        return view('test',compact('questions', 'answers'))->with('id', $id)->with('kelintas', $kelintas)->with('howmuch', $howmuch);
    }
    public function testSolutionV2($id, Request $request, $kelintas){

        //Vaikščiojimas tarp klausimų
        $kelintas++;
        $howmuch = Question::count();
        if($howmuch > $kelintas) {
            $questionsid = Question::where(['Test_idTest' => $id])->pluck('idQuestion');
            $questions = Question::where(['idQuestion' => $questionsid[$kelintas]])->get();
            $answers = Answer::where(['Question_idQuestion' => $questionsid[$kelintas]])->get(); // ga padaryti, kad vietoj nulio keistusi reikšmė
        }
        else{
            $questions = 0;
            $answers = 0;
        }
        //

        return view('test',compact('questions', 'answers'))->with('id', $id)->with('kelintas', $kelintas)->with('howmuch', $howmuch);
    }
}
