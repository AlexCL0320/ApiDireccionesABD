<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'modelo'];

    public function users(){
        return $this->belongsToMany(User::class);
    }
}
