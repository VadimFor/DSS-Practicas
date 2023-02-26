<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $table = 'menu';

    public function restaurante(){
        return $this->belongsTo(Restaurante::class);
    }
    public function valoracion() {
        return $this->hasMany(Valoracion::class);
    }
    public function plato() {
        return $this->hasMany(Plato::class);
    }
}
