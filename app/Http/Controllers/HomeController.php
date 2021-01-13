<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Question;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // take data
        $questions = Question::orderBy('id', 'desc')->get();
        $users = User::orderBy('id', 'desc')->get();

        // view
        $data = [
            'questions' => $questions,
            'users' => $users
        ];
        return view('home', $data);
    }
}
