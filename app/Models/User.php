<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $table = 'user';

    public function valoracion() {
        return $this->hasMany(Valoracion::class);
    }
    
    #Para que la contraseña se guarde hasheada
    public function setPasswordAttribute($value){
        $this->attributes['password'] = bcrypt($value);
    }
}


