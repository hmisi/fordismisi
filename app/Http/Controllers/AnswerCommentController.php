<?php

namespace App\Http\Controllers;

use App\AnswerComment;
use Illuminate\Http\Request;

class AnswerCommentController extends Controller
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
         AnswerComment::create($request->all());
         return redirect('/home')->with('status', 'Komentar dikirim!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AnswerComment  $answerComment
     * @return \Illuminate\Http\Response
     */
    public function show(AnswerComment $answerComment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AnswerComment  $answerComment
     * @return \Illuminate\Http\Response
     */
    public function edit(AnswerComment $answerComment)
    {
        return view('edit_answer_comment', compact('answerComment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AnswerComment  $answerComment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AnswerComment $answerComment)
    {
         // validasi
         $request->validate([
            'content' => 'required'
        ]);
        AnswerComment::where('id', $answerComment->id)->update([
            'content' => $request->content
        ]);
        return redirect('/home')->with('status', 'Komentar Diubah!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AnswerComment  $answerComment
     * @return \Illuminate\Http\Response
     */
    public function destroy(AnswerComment $answerComment)
    {
        AnswerComment::destroy($answerComment->id);
        return redirect('/home')->with('status', 'Komentar jawaban Dihapus!!');
    }
}
