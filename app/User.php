<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Model\UserType;
use App\Model\MatchDay;
use App\Model\MatchResponse;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_type_id', 'email', 'password', 'name', 'last_name', 'phone', 'status'
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
     * return mixed
     */
    public function type()
    {
        return $this->belongsTo(UserType::class, 'user_type_id');
    }

    /**
     * Retorna todos los partidos creados por el usuario
     */
    public function matchesDay()
    {
        return $this->hasMany(MatchDay::class, 'user_id');
    }

    /**
     * Devuelve todas las respuesta del
     */
    public function matchResponses()
    {
        return $this->belongsToMany(MatchDay::class, 'match_responses', 'user_id', 'match_day_id')
            ->withTimestamps()
            ->withPivot('answer')
            ->using(MatchResponse::class);
    }

}
