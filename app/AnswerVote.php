<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnswerVote extends Model
{
    protected $table = 'answer_votes';

    protected $fillable = [
        'answer_id', 'user_id', 'vote'
    ];

    public function answer()
    {
        return $this->belongsTo(Answer::class, 'answer_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
