<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
     protected $fillable = [
        'user_id', 'role_id',
    ];

    public function users(){
        return $this->hasMany('App\User', 'id', 'user_id');
    }
}
