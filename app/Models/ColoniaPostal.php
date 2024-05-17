<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColoniaPostal extends Model
{
    use HasFactory;
    protected $fillable = [
        'colonia_id',
        'codigo_postal_id',
    ];

    public function colonia()
    {
        return $this->belongsTo(Colonia::class, 'colonia_id');
    }

    public function codigoPostal()
    {
        return $this->belongsTo(CodigoPostal::class, 'codigo_postal_id');
    }
}
