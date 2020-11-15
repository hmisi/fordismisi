<?php

namespace App\Http\Controllers;

use App\Question;
use App\QuestionComment;
use App\Tag;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);
        // insert data
        $question = Question::create($request->all());

        // inserting tag to question
        foreach (explode(' ', $request->tags) as $tag) {
            $tag = Tag::firstOrCreate(['name' => $tag]);
            $question->tags()->attach($tag);
        }

        return redirect('/home')->with('status', 'Pertanyaan dikirim!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        return view('edit_question', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        // validasi
        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);
        $question->update([
            'title' => $request->title,
            'content' => $request->content
        ]);

        // updating tags
        $tagIds = [];
        foreach (explode(' ', $request->tags) as $tag) {
            $tag = Tag::firstOrCreate(['name' => $tag]);
            $tagIds[] = $tag->id;
        }
        $question->tags()->sync($tagIds);

        return redirect('/home')->with('status', 'Pertanyaan Diubah!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return redirect('/home')->with('status', 'Pertanyaan Dihapus!!');
    }
}
