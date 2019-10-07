<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;

class UserType extends Model
{
    
    protected $table = 'user_types';

    protected $primaryKey = "id";

    protected $fillable = [
        'name',
        'status'
    ];

    /**
     * Retorna todos los usuarios asignados
     */
    public function users()
    {
        return $this->hasMany(User::class, 'user_id');
    }

}
