<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Category;
use App\Models\User;
use App\Models\Comment;
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
        $userProfile = User::all();
        return view('myTestsList', compact('posts', 'userProfile'));
    }
    public function otherindex()
    {
        $otherposts = Post::all();
        return view('testsList', compact('otherposts'));
    }
    public function show($id)
    {
        $post = Post::find($id);
        $name = $post->user->name;
        $surname = $post->user->surname;
        if($post->ratingSum != null) {
            $avarage = $post->ratingSum / $post->ratingCount;
        }
        else{
            $avarage = 0;
        }

        $data = Comment::where(['Test_idTest' => $id])->get();         
       
        return view('testInfo', ['comments' => $data], compact('post'))->with('avarage', $avarage)->with('name', $name)->with('surname', $surname);
    }

    
    public function updateComment(Request $request, $testid, $commentid)
    {
        $comment= $request->get('comment');

        $post = Post::find($testid);
        if($post->ratingSum != null) {
            $avarage = $post->ratingSum / $post->ratingCount;
        }
        else{
            $avarage = 0;
        }

      
        Comment::where('idComment', $commentid) -> update(['comment' => $comment]);

        $data = Comment::where(['Test_idTest' => $testid])->get();

        return view('testInfo', ['comments' => $data], compact('post'))->with('avarage', $avarage)->with('name', $name)->with('surname', $surname);
    }

    public function deleteComment($testid, $commentid)
    {
        $post = Post::find($testid);
        if($post->ratingSum != null) {
            $avarage = $post->ratingSum / $post->ratingCount;
        }
        else{
            $avarage = 0;
        }

        $comment = Comment::find($commentid)->delete();

        $data = Comment::where(['Test_idTest' => $testid])->get();

        return view('testInfo', compact('post'))->with('avarage', $avarage)->with('name', $name)->with('surname', $surname);
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
    public function addComment(Request $request, $testid, $userid){
       
        $comment = new Comment;
        $comment->comment = $request->get('komentaras');
        $comment->Test_idTest = $testid;
        $comment->User_idUser = Auth::user()->id;
        $comment->save();

        $post = Post::find($testid);
        if($post->ratingSum != null) {
            $avarage = $post->ratingSum / $post->ratingCount;
        }
        else{
            $avarage = 0;
        }

        $data = Comment::where(['Test_idTest' => $testid])->get();

           
       
        return view('testInfo', ['comments' => $data], compact('post'))->with('avarage', $avarage);

        //return redirect()->back();  

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
            $questID = Question::where([ 'test_idTest' => $testID[$count]])->pluck('idQuestion');
                $data = array(
                    'answer' => $answer[$count],
                    'is_Correct' => $is_Correct[$count],
                    'Question_idQuestion' => $questID[$count]
                );


            $insert_data1[] = $data;
        }
        for ($count = 0; $count < count($answer1); $count++) {
            $questID = Question::where([ 'test_idTest' => $testID[$count]])->pluck('idQuestion');
                $data = array(
                    'answer' => $answer1[$count],
                    'is_Correct' => $is_Correct1[$count],
                    'Question_idQuestion' => $questID[$count]
                );


            $insert_data2[] = $data;
        }
        for ($count = 0; $count < count($answer2); $count++) {
            $questID = Question::where([ 'test_idTest' => $testID[$count]])->pluck('idQuestion');

                $data = array(
                    'answer' => $answer2[$count],
                    'is_Correct' => $is_Correct2[$count],
                    'Question_idQuestion' => $questID[$count]
                );


            $insert_data3[] = $data;
        }
        for ($count = 0; $count < count($answer3); $count++) {
            $questID = Question::where([ 'test_idTest' => $testID[$count]])->pluck('idQuestion');

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
        $score = 0;
        $correct = 0;
        $howmuch = Question::count();
        $questions = Question::where(['Test_idTest' => $id])->take(1)->get();

        $questionsid = Question::where(['Test_idTest' => $id])->pluck('idQuestion');
        $answers = Answer::where(['Question_idQuestion' => $questionsid[0]])->get(); // ga padaryti, kad vietoj nulio keistusi reikšmė

        $questionsWeight = Question::where(['idQuestion' => $questionsid[$kelintas]])->pluck('weight');; //paima klausimo svorį


        return view('test',compact('questions', 'answers'))->with('score', $score)->with('correct', $correct)->with('id', $id)->with('kelintas', $kelintas)->with('howmuch', $howmuch)->with('questionsWeight', $questionsWeight);
    }
    public function testSolutionV2($id, Request $request, $kelintas){

        $score = (double) $request->get('score');
        $correct = (int) $request->get('correct');
        //dd($score);
        //Vaikščiojimas tarp klausimų
        $kelintas++;

        //$howmuch = Question::count();
        $questionsWeightSum = Question::where(['Test_idTest' => $id])->sum('weight');
        $howmuch = Question::where(['Test_idTest' => $id])->count();
        //dd($kelintas);
        if($howmuch > $kelintas) {
            $questionsid = Question::where(['Test_idTest' => $id])->pluck('idQuestion');
            $questions = Question::where(['idQuestion' => $questionsid[$kelintas]])->get();
            $answers = Answer::where(['Question_idQuestion' => $questionsid[$kelintas]])->get(); // ga padaryti, kad vietoj nulio keistusi reikšmė
            $questionsWeight = Question::where(['idQuestion' => $questionsid[$kelintas]])->pluck('weight');; //paima klausimo svorį
        }
        else{
            $questions = 0;
            $answers = 0;
            $questionsWeight = 0;
        }
        //
        $mark = $score / $questionsWeightSum * 10;

        return view('test',compact('questions', 'answers'))->with('mark', $mark)->with('score', $score)->with('correct', $correct)->with('id', $id)->with('kelintas', $kelintas)->with('howmuch', $howmuch)->with('questionsWeight', $questionsWeight);
    }
    public function testAnswers($id, Request $request, $kelintas){

        //stuff
        $score = (double) $request->get('score');
        $correct = (int) $request->get('correct');
        $howmuch = Question::where(['Test_idTest' => $id])->count();
        //dd($score);

        //Atsakymų paėmimas
        $rules = array(
            'is_Correct.*' => 'required',

        );
        $error = Validator::make($request->all(), $rules);
        if ($error->fails()) {
            return response()->json([
                'error' => $error->errors()->all()
            ]);
        }
        $is_Correct = $request->is_Correct;
       // dd($is_Correct);
        $answerID = array_keys($is_Correct, "1");

        //dd($answerID[1]);


        $questionsid = Question::where(['Test_idTest' => $id])->pluck('idQuestion'); //paima klausimo id
        $questions = Question::where(['idQuestion' => $questionsid[$kelintas]])->get(); //paima klausima
        $questionsWeight = Question::where(['idQuestion' => $questionsid[$kelintas]])->pluck('weight');; //paima klausimo svorį
        $answers = Answer::where(['Question_idQuestion' => $questionsid[$kelintas]])->get(); // paima atsakymo variantus

        $bad = 0;

        //Jeigu vartotojas bent vieną suklystą gauna bad= 1, bet jeigu vieną pataiko ir daugiau nieko gauna bad=0
        $ansgooduser = 0;
        for ($count = 0; $count < count($is_Correct); $count++) {
            $corAns = Answer::find($answerID[$count]);
            if($corAns->is_Correct == 1){
                $ansgooduser++;
             $goodid[$count] = $corAns->idAnswers;
            }
            else{
                $goodid[$count] = 0;
                $bad= 1;
            }
        }

        //Sutvarkymas, kad būtų 100% correct stuff
        $ansgood= 0;
        for ($count = 0; $count < count($answers); $count++) {
            $corAns = Answer::where(['Question_idQuestion' => $questions->pluck('idQuestion')])->pluck('is_Correct');
            if($corAns[$count] == 1){
                $ansgood++;
            }
        }
        if($ansgood != $ansgooduser){
            $bad = 1;
        }
        //dd($ansgood);
        if($bad == 0 && $ansgood == $ansgooduser){
           $score = $score + $questionsWeight[0];
           $correct++;
        }
        return view('testFeedback',compact('questions', 'answers', 'goodid'))->with('howmuch',$howmuch)->with('score', $score)->with('correct', $correct)->with('id', $id)->with('kelintas', $kelintas)->with('bad', $bad)->with('questionsWeight', $questionsWeight);
    }
    public function testDone($id, $mark, Request $request){

        //Posto stuff
        $test = Post::find($id);
        $test->completedCount++;
        //dd($request->get('stars'));
        if($request->get('stars') != null) {
            $test->ratingSum = $test->ratingSum + $request->get('stars');
            $test->ratingCount++;
        }
        $test->save();

        //Userio stuff
        $userInf = User::find(Auth::user()->id);
        $userInf->testCount++;
        $userInf->testMarkSum= $userInf->testMarkSum +$mark;
        if($mark >= 5){
            $userInf->currency++;
        }
        $userInf->save();
        //dd($userInf);
        return redirect()->route('otherpostss')->with('status','Pasirinktas testas ištrintas');
    }
}
