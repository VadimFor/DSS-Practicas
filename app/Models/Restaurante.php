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
        'img'
    ];

    public function menu() {
        return $this->hasOne(Menu::class);
    }
    
}
