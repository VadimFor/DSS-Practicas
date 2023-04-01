<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Valoracion extends Model
{
    use HasFactory;
    protected $table = 'valoracion';

    public $timestamps = false;

    protected $fillable = [
        'users_id',
        'menu_id',
        'comentario',
        'puntuacion'
    ];
    
    public function menu(){
        return $this->belongsTo(Menu::class,'menu_id');
    }
    public function usuario(){
        return $this->belongsTo(Users::class,'users_id');
    }
}
