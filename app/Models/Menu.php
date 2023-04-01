<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $table = 'menu';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'restaurante_id',
        'img'
    ];

    public function restaurante(){
        return $this->belongsTo(Restaurante::class,'restaurante_id');
    }
    public function valoracion() {
        return $this->hasMany(Valoracion::class);
    }
    public function plato() {
        return $this->hasMany(Plato::class);
    }
}
