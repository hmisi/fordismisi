<?php

namespace App\Http\Controllers;

use App\Answer;
use App\AnswerVote;
use Illuminate\Http\Request;

class AnswerVoteController extends Controller
{
    public function vote(Answer $answer, Request $request)
    {
        $request->validate([
            'vote' => 'required|boolean'
        ]);

        // check if user was the answer's author
        if ($answer->user == $request->user()) {
            return redirect()->back()->with([
                'danger' => 'Anda tidak dapat memberikan vote pada jawaban anda sendiri.'
            ]);
        }

        // check if user has already voted
        if ($answer->hasVotedBy($request->user())) {
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

        $newVote = AnswerVote::create([
            'vote' => $request->vote,
            'answer_id' => $answer->id,
            'user_id' => auth()->id()
        ]);

        if ($newVote->vote == 1) {
            $answer->user->gainUpVote();
        } else {
            $answer->user->gainDropVote();
        }

        return redirect()->back()->with([
            'status' => 'Berhasil memberikan vote.'
        ]);
    }
}
