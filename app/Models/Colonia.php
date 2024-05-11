<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colonia extends Model
{
    use HasFactory;
    protected $fillable = ['nombre','municipio_id'];
    public function municipio()
    {
        return $this->belongsTo(Municipio::class);
        return $this->hasOne(Municipio::class,'id','municipio_id');
    }
    public function direccions(){
        return $this->hasMany(Direccions::class, 'colonia_id');
    }
}
