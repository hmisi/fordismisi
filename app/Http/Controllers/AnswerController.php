<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validasi
        $request->validate(['content' => 'required']);
        // insert data
        Answer::create($request->all());

        $question = Question::where('id', $request->question_id)->first();



        return redirect('/pertanyaan/'. $question->slug)->with('status', 'Jawaban dikirim!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function show(Answer $answer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Answer $answer)
    {
        return view('edit_answer', compact('answer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Answer $answer)
    {
        // validasi
        $request->validate([
            'content' => 'required'
        ]);
        $answer->update([
            'content' => $request->content
        ]);

        $question = Question::where('id', $answer->question_id)->first();



        return redirect('/pertanyaan/'. $question->slug)->with('status', 'Jawaban diupdate!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Answer $answer)
    {
        $answer->delete();

        $question = Question::where('id', $answer->question_id)->first();



        return redirect('/pertanyaan/'. $question->slug)->with('status', 'Jawaban dihapus!!');
    }

    public function approved(Request $request, Answer $answer)
    {
        $answer->update([
            'best_answer' => $request->best_answer
        ]);

        $question = Question::where('id', $answer->question_id)->first();



        return redirect('/pertanyaan/'. $question->slug)->with('status', 'Jawaban diapproved!!');
    }
}
