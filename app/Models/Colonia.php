<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ColoniaPostal;

class Colonia extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'no_col','municipio_id'];
    
    //Lave foranea a direccion
    public function direccions(){
        return $this->hasMany(Direccions::class, 'colonia_id');
    }

    public function colonias_postals(){
        return $this->hasMany(ColoniaPostal::class, 'colonia_id');
    }
}
