<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Model\MatchDay;
use App\User;

class MatchResponse extends Pivot
{
    
    protected $table = 'match_responses';

    protected $primaryKey = 'id';

    protected $fillable = [
        'answer',
    ];

    /**
     * Devuelve el partido
     */
    public function matchDay()
    {
        return $this->belongsTo(MatchDay::class, 'match_day_id');
    }

    /**
     * Devuele el usuario
     */
    public function user() 
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
