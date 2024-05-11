<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'modelo'];

    public function colonias(){
        return $this->hasMany(Colonias::class, 'municipio_id');
    }
}

