<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'reputation_point'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function gainUpVote($point = 10)
    {
        $this->reputation_point += $point;

        return $this->save();
    }

    public function gainDropVote($point = 1)
    {
        $this->reputation_point -= $point;

        return $this->save();
    }

    public function isAbleToDownVote()
    {
        return $this->reputation_point >= 15 ? true : false;
    }
}
