<?php

namespace App\Http\Controllers;

use App\Question;
use App\QuestionComment;
use Illuminate\Http\Request;

class QuestionCommentController extends Controller
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
         QuestionComment::create($request->all());


        $questionID = Question::where('id', $request->question_id)->get();
        return redirect('/pertanyaan/'.$questionID[0]->id)->with('status', 'Komentar ditambah!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\QuestionComment  $questionComment
     * @return \Illuminate\Http\Response
     */
    public function show(QuestionComment $questionComment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\QuestionComment  $questionComment
     * @return \Illuminate\Http\Response
     */
    public function edit(QuestionComment $questionComment)
    {
        return view('edit_question_comment', compact('questionComment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\QuestionComment  $questionComment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QuestionComment $questionComment)
    {
        // validasi
        $request->validate([
            'content' => 'required'
        ]);
        QuestionComment::where('id', $questionComment->id)->update([
            'content' => $request->content
        ]);
        $questionID = Question::where('id', $questionComment->question_id)->get();
        return redirect('/pertanyaan/'.$questionID[0]->id)->with('status', 'Komentar diubah!!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\QuestionComment  $questionComment
     * @return \Illuminate\Http\Response
     */
    public function destroy(QuestionComment $questionComment)
    {
        QuestionComment::destroy($questionComment->id);
        $questionID = Question::where('id', $questionComment->question_id)->get();
        return redirect('/pertanyaan/'.$questionID[0]->id)->with('status', 'Komentar dihapus!!');

    }
}
