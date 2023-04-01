<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;
    public $timestamps = false;
    
    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'apellido',
        'telefono',
        'direccion',
        'pais',
        'provincia',
        'poblacion',
        'cod_postal'
    ];

    protected $hidden = ['password'];

    public function setPasswordAttribute($value){
        $this->attributes['password'] = bcrypt($value);
    }


    public function restaurantes()
    {
        return $this->hasMany(Restaurante::class);
    }

    public function valoraciones()
    {
        return $this->hasMany(Valoracion::class);
    }
}
