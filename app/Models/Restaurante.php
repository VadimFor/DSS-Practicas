<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurante extends Model
{
    use HasFactory;
    protected $table = 'restaurante';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'direccion',
        'telefono',
        'descripcion',
        'img',
        'users_id'
    ];

    public function menu() {
        return $this->hasMany(Menu::class);
    }

    public function usuario()
    {
        return $this->belongsTo(Users::class,'users_id');
    }
    
}
