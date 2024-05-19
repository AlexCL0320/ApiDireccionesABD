<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ColoniaPostal;

class CodigoPostal extends Model
{
    use HasFactory;
    protected $fillable = ['codigo'];
    
    //Lave foranea a direccion
    public function direccions(){
        return $this->hasMany(Direccions::class, 'colonia_id');
    }

    public function colonias_postals(){
        return $this->hasMany(ColoniaPostal::class, 'codigo_postal_id');
    }
}
