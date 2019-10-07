<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;

class MatchDay extends Model
{
    
    protected $table = 'matches_day';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'status',
    ];

    /**
     * Retorna el usuario responsable del partido
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Se obtiene las respuesta del partido
     */
    public function responses()
    {
        return $this->hasMany(MatchResponse::class, 'match_day_id');
    }

    /**
     * Devuelve todas las respuesta del
     */
    public function matchResponses()
    {
        return $this->belongsToMany(MatchDay::class, 'match_responses', 'user_id', 'match_day_id')
            ->using(MatchResponse::class);
    }

}
