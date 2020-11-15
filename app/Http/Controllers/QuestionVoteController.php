<?php

namespace App\Http\Controllers;

use App\Question;
use App\QuestionVote;
use Illuminate\Http\Request;

class QuestionVoteController extends Controller
{
    public function vote(Question $question, Request $request)
    {
        $request->validate([
            'vote' => 'required|boolean'
        ]);

        // check if user was the question's author
        if ($question->user == $request->user()) {
            return redirect()->back()->with([
                'danger' => 'Anda tidak dapat memberikan vote pada pertanyaan anda sendiri.'
            ]);
        }

        // check if user has already voted
        if ($question->hasVotedBy($request->user())) {
            return redirect()->back()->with([
                'danger' => 'Anda sudah memberikan vote.'
            ]);
        }

        // check if user is able to downvote
        if ($request->vote == 0) {
            if (!$request->user()->isAbleToDownVote()) {
                return redirect()->back()->with([
                    'danger' => 'Anda tidak dapat melakukan downvote. Minimal reputasi poin untuk melakukan downvote adalah 15 poin.'
                ]);
            }
        }

        $newVote = QuestionVote::create([
            'vote' => $request->vote,
            'question_id' => $question->id,
            'user_id' => auth()->id()
        ]);

        if ($newVote->vote == 1) {
            $question->user->gainUpVote();
        } else {
            $question->user->gainDropVote();
        }

        return redirect()->back()->with([
            'status' => 'Berhasil memberikan vote.'
        ]);
    }
}
