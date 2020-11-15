<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Question;
use App\QuestionComment;
use App\Answer;
use App\AnswerComment;
use App\BestAnswer;
use App\user;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // take data
        $questions = Question::orderBy('id', 'desc')->get();
        $questComents = QuestionComment::orderBy('id', 'desc')->get();
        $answers = Answer::orderBy('id', 'desc')->get();
        $answerComents = AnswerComment::orderBy('id', 'desc')->get();
        $users = User::orderBy('id', 'desc')->get();

        // view
        $data = [
            'title' => "Welcome To Larahub",
            'questions' => $questions,
            'questComents' => $questComents,
            'answers' => $answers,
            'answerComents' => $answerComents,
            'users' => $users
        ];
        return view('home', $data);
    }
}
