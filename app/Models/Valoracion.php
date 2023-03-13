<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Valoracion extends Model
{
    use HasFactory;
    protected $table = 'valoracion';

    public $timestamps = false;
    
    public function menu(){
        return $this->belongsTo(Menu::class);
    }
    public function usuario(){
        return $this->belongsTo(Usuario::class);
    }
}
