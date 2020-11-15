<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionVote extends Model
{
    protected $table = 'question_votes';

    protected $fillable = [
        'question_id', 'user_id', 'vote'
    ];

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
