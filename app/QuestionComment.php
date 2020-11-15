<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionComment extends Model
{
    protected $table = 'question_comments';

    protected $fillable = [
        'question_id', 'user_id', 'content'
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
