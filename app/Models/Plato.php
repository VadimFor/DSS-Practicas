<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plato extends Model
{
    use HasFactory;
    protected $table = 'plato';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'descripcion',
        'menu_id',
        'img'
    ];

    public function menu(){
        return $this->hasMany(Menu::class);
    }
}
