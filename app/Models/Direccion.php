<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    use HasFactory;
    protected $fillable = ['colonia_id', 'calle', 'numero_ex',  'numero_int', 'modelo'];

    public function users(){
        return $this->belongsToMany(User::class);
    }
}
