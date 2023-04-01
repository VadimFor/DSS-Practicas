<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    protected $table = 'users';
    
    use HasApiTokens, HasFactory, Notifiable;
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
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

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    #Para que la contraseña se guarde hasheada
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
