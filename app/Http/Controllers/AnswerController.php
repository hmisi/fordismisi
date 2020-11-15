<?php

namespace App\Http\Controllers;

use App\Answer;
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

        return redirect('/home')->with('status', 'Jawaban dikirim!!');
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

        return redirect('/home')->with('status', 'Jawaban Diubah!!');
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

        return redirect('/home')->with('status', 'jawaban Dihapus!!');
    }

    public function approved(Request $request, Answer $answer)
    {
        $answer->update([
            'best_answer' => $request->best_answer
        ]);

        return redirect('/home')->with('status', 'Jawaban Terbaik Diatur!!');
    }
}
