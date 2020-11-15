<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnswerComment extends Model
{
    protected $table = 'answer_comments';

    protected $fillable = [
        'answer_id', 'user_id', 'content'
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
