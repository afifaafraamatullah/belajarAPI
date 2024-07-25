<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class actor extends Model
{
    use HasFactory;
    
    public function film()
    {
        return $this->belongToMany(film::class,'genre_film','id_genre','id_film');
    }
}
