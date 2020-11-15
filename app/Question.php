<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';

    protected $fillable = [
        'title', 'content', 'user_id'
    ];

    public function delete()
    {
        $this->answers()->delete();
        $this->comments()->delete();
        $this->votes()->delete();

        return parent::delete();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'question_tag', 'question_id', 'tag_id');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function comments()
    {
        return $this->hasMany(QuestionComment::class);
    }

    public function votes()
    {
        return $this->hasMany(QuestionVote::class);
    }

    public function hasVotedBy($user)
    {
        return $this->votes->where('user_id', $user->id)->count() ? true : false;
    }

    public function vote_point()
    {
        $votes = $this->votes;

        if ($votes) {
            $upVote = $votes->where('vote', 1)->count();
            $downVote = $votes->where('vote', 0)->count();

            return $upVote - $downVote;
        } else {
            return 0;
        }
    }
}
